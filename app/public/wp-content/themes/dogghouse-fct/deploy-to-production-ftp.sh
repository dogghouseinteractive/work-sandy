#!/usr/bin/env bash
#
# Deploy dogghouse-fct theme to production via FTP.
#
# Password is read from macOS Keychain automatically (same credential Transmit uses).
# Or pass FTP_PASSWORD explicitly.
#
# Requires: lftp (brew install lftp), python3
#
# Usage:
#   ./deploy-to-production-ftp.sh
#   FTP_PASSWORD='...' ./deploy-to-production-ftp.sh
#
# Optional env overrides:
#   FTP_USER   FTP_HOST   FTP_PORT   REMOTE_THEME_PATH   FTP_DEBUG
#

set -euo pipefail

FTP_USER="${FTP_USER:-dogghouse}"
FTP_HOST="${FTP_HOST:-34.218.255.8}"
FTP_PORT="${FTP_PORT:-21}"
FTP_DEBUG="${FTP_DEBUG:-}"
REMOTE_THEME_PATH="${REMOTE_THEME_PATH:-httpdocs/wp-content/themes/dogghouse-fct/}"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
LOCAL_PATH="$SCRIPT_DIR"

YELLOW='\033[1;33m'
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m'

if ! command -v lftp >/dev/null 2>&1; then
	echo -e "${RED}lftp is not installed.${NC} Install with:  brew install lftp"
	exit 1
fi

if ! command -v python3 >/dev/null 2>&1; then
	echo -e "${RED}python3 is required (for safe URL encoding).${NC}"
	exit 1
fi

if [[ ! -f "$LOCAL_PATH/style.css" ]]; then
	echo -e "${RED}Run this script from the dogghouse-fct theme directory.${NC}"
	exit 1
fi

# Auto-read from macOS Keychain (same credential Transmit stores).
if [[ -z "${FTP_PASSWORD:-}" ]]; then
	for KC_SERVER in "$FTP_HOST" "34.218.255.8" "phost3.worksandy.com"; do
		FTP_PASSWORD="$(security find-internet-password -s "$KC_SERVER" -a "$FTP_USER" -w 2>/dev/null || true)"
		if [[ -n "$FTP_PASSWORD" ]]; then
			echo -e "${GREEN}Password loaded from Keychain (server=${KC_SERVER}, account=${FTP_USER}).${NC}"
			break
		fi
	done
fi

if [[ -z "${FTP_PASSWORD:-}" ]]; then
	read -r -s -p "FTP password for ${FTP_USER}@${FTP_HOST}: " FTP_PASSWORD
	echo ""
fi

if [[ -z "${FTP_PASSWORD}" ]]; then
	echo -e "${RED}Password is required.${NC}"
	exit 1
fi

echo -e "${YELLOW}Deploying to ${FTP_USER}@${FTP_HOST}:${FTP_PORT} -> ${REMOTE_THEME_PATH}${NC}"
echo ""

TMP_SCRIPT=$(mktemp)
chmod 600 "$TMP_SCRIPT"

export FTP_USER FTP_PASSWORD FTP_HOST FTP_PORT FTP_DEBUG REMOTE_THEME_PATH LOCAL_PATH TMP_SCRIPT

python3 <<'PY'
import os
import urllib.parse

out = open(os.environ["TMP_SCRIPT"], "w", encoding="utf-8")

def q(path):
    return "'" + path.replace("'", "'\\''") + "'"

u = os.environ["FTP_USER"]
p = os.environ["FTP_PASSWORD"]
host = os.environ["FTP_HOST"]
port = os.environ["FTP_PORT"]
remote = os.environ["REMOTE_THEME_PATH"].rstrip("/")
local = os.environ["LOCAL_PATH"]

uq = urllib.parse.quote(u, safe="")
pq = urllib.parse.quote(p, safe="")
url = f"ftp://{uq}:{pq}@{host}:{port}"

if os.environ.get("FTP_DEBUG", "").strip() in ("1", "true", "yes"):
    out.write("debug\n")

out.write("set net:max-retries 5\n")
out.write("set net:timeout 90\n")
out.write("set net:reconnect-interval-base 3\n")
out.write("set ftp:ssl-allow no\n")
out.write("set ftp:passive-mode no\n")
out.write(f"open {url}\n")
out.write(f"mkdir -p {q(remote)}\n")
out.write(f"cd {q(remote)}\n")
out.write(f"lcd {q(local)}\n")
out.write("mirror -R --verbose \\\n")
out.write("  --only-newer \\\n")
out.write("  --no-perms \\\n")
out.write("  --exclude-glob .git/ \\\n")
out.write("  --exclude-glob .gitignore \\\n")
out.write("  --exclude-glob node_modules/ \\\n")
out.write("  --exclude-glob .DS_Store \\\n")
out.write("  --exclude-glob '*.sh' \\\n")
out.write("  --exclude-glob '*.md' \\\n")
out.write("  --exclude-glob '*.py' \\\n")
out.write("  . .\n")
out.write("bye\n")
out.close()
PY

if ! lftp -f "$TMP_SCRIPT"; then
	rm -f "$TMP_SCRIPT"
	echo ""
	echo -e "${RED}FTP deploy failed. Try: FTP_DEBUG=1 ./deploy-to-production-ftp.sh${NC}"
	exit 1
fi
rm -f "$TMP_SCRIPT"

echo ""
echo -e "${GREEN}FTP deployment finished.${NC}"
