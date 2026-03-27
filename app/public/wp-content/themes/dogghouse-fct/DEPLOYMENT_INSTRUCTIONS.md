# Deployment — Work Sandy (`dogghouse-fct` theme)

## Quick start

```bash
cd "/Users/troycono/Local Sites/work-sandy/app/public/wp-content/themes/dogghouse-fct"
chmod +x deploy-to-production-ftp.sh
./deploy-to-production-ftp.sh
```

The script reads the FTP password from **macOS Keychain** automatically (same credential Transmit uses). No password argument needed.

## Deploy scripts

| Script | Protocol | When to use |
|--------|----------|-------------|
| `deploy-to-production-ftp.sh` | **FTP** (active mode, port 21) | **Primary** — works with Work Sandy's ProFTPD server |
| `deploy-to-production.sh` | **rsync over SSH** (key-based) | Only if SSH key access is set up on the server |

The FTP script uses **lftp** (`brew install lftp`) and **python3** (for URL-encoding the password safely).

### What the FTP script does

1. Reads FTP password from Keychain (or prompts / accepts `FTP_PASSWORD` env var)
2. Connects to `dogghouse@34.218.255.8:21` (plain FTP, active mode)
3. Mirrors the theme to `httpdocs/wp-content/themes/dogghouse-fct/`
4. Only uploads **newer** files (`--only-newer`) — fast after the first deploy
5. Excludes `.git/`, `*.sh`, `*.md`, `*.py`, `.DS_Store`, `node_modules/`

### Optional overrides

```bash
FTP_USER=dogghouse FTP_HOST=34.218.255.8 FTP_PORT=21 ./deploy-to-production-ftp.sh
FTP_DEBUG=1 ./deploy-to-production-ftp.sh    # verbose lftp output
```

### Helper: check remote paths

```bash
chmod +x ftp-print-remote-path.sh
./ftp-print-remote-path.sh
```

Lists the remote directory structure (reads Keychain too).

## Server details

| | Value |
|---|-------|
| FTP host | `34.218.255.8` (hostname: `phost3.worksandy.com`) |
| FTP port | `21` |
| FTP user | `dogghouse` |
| FTP mode | Active (passive data ports are firewalled) |
| TLS | Not used (plain FTP) |
| Remote root | `/` (FTP home) |
| Theme path | `httpdocs/wp-content/themes/dogghouse-fct/` |

## Repo layout

| | **iso-rad** | **work-sandy** |
|---|-------------|----------------|
| Git repo | Often just the theme folder | Whole Local site folder: `work-sandy/` |
| Theme on disk | `dogghouse-fct/` at repo root | `app/public/wp-content/themes/dogghouse-fct/` |

`wp-config.php` is **gitignored**; production keeps its own DB credentials.

## Standard workflow

1. Develop in Local; theme files live under `dogghouse-fct/`.
2. Commit from the repo root:
   ```bash
   cd "/Users/troycono/Local Sites/work-sandy"
   git add -A && git commit -m "Describe change" && git push
   ```
3. Deploy the theme:
   ```bash
   cd "/Users/troycono/Local Sites/work-sandy/app/public/wp-content/themes/dogghouse-fct"
   ./deploy-to-production-ftp.sh
   ```

## After deploy

- Clear any host/plugin/CDN cache.
- Production database is separate; scripts like `script/delete-spam-comments.php` must run on production (SSH + PHP CLI or phpMyAdmin).

## Troubleshooting

- **530 Login incorrect**: FTP password may have changed. Check Transmit or reset in the hosting panel.
- **Connection refused**: Too many failed login attempts triggers a temporary IP ban (~15-30 min).
- **Passive mode timeout**: The server's passive data ports are firewalled. The script uses active mode (`ftp:passive-mode no`).
- **Wrong path**: Run `./ftp-print-remote-path.sh` to see the remote directory structure.
