# CryptoJet — Azure Static Web App rewrite

This replaces the original PHP + MySQL app with an architecture that actually
runs on Azure Static Web Apps:

```
app/   -> static frontend (HTML/CSS/vanilla JS) — deployed as the SWA "app" content
api/   -> Azure Functions (Node.js) — deployed as the SWA's linked "Managed Functions" API
db/    -> schema.sql for Azure SQL Database
```

## What changed vs. the original PHP app, and why

| Original | Rewrite | Why |
|---|---|---|
| PHP pages doing inline `mysqli_query` | Azure Functions (Node) using parameterized queries via `mssql` | Static Web Apps can't run PHP. The old queries also built SQL by string concatenation (`"...WHERE username = '$suname'..."`), which is a SQL injection hole — fixed as part of the rewrite. |
| MySQL (`mysqli_connect`) | Azure SQL Database | Pairs natively with SWA managed Functions; no separate VM/App Service needed. |
| Passwords stored in plaintext (`pass` column, compared with `=`) | bcrypt-hashed (`passHash`), compared with `bcrypt.compare` | Trivial to do right while rewriting anyway — storing plaintext passwords is not something to carry forward. |
| Six near-duplicate `trade-btc.php`, `trade-eth.php`, ... files | One `/api/trade` endpoint parameterized by `coin` | Same logic, no duplication. |
| CoinAPI key embedded directly in PHP page source | CoinAPI key read from `COINAPI_KEY` app setting, used only server-side in the Function, with a 30s cache | Key never reaches the browser; original PHP also kept it server-side, this just also avoids re-hitting CoinAPI on every page load. |
| Login state passed as `?id=123` in every URL | `clientId` stored in `sessionStorage` after `/api/login` | Keeps the identifier out of shareable URLs. **Note:** this is still not real authentication — see "Next steps" below. |

## 1. Create Azure resources

```bash
# Resource group
az group create -n cryptojet-rg -l eastus

# Azure SQL server + database (adjust admin/password)
az sql server create -g cryptojet-rg -n cryptojet-sql --admin-user sqladmin --admin-password '<STRONG_PASSWORD>'
az sql db create -g cryptojet-rg -s cryptojet-sql -n cryptojet --service-objective Basic
az sql server firewall-rule create -g cryptojet-rg -s cryptojet-sql -n AllowAzureServices --start-ip-address 0.0.0.0 --end-ip-address 0.0.0.0

# Static Web App (choose your GitHub repo when prompted, or deploy via CLI below)
az staticwebapp create -g cryptojet-rg -n cryptojet-swa -l eastus2
```

## 2. Load the schema

```bash
sqlcmd -S cryptojet-sql.database.windows.net -d cryptojet -U sqladmin -P '<STRONG_PASSWORD>' -i db/schema.sql
```

## 3. Configure app settings on the Static Web App

In the Azure Portal → your Static Web App → **Configuration**, add:

- `SQL_SERVER` = `cryptojet-sql.database.windows.net`
- `SQL_DATABASE` = `cryptojet`
- `SQL_USER` = `sqladmin`
- `SQL_PASSWORD` = `<STRONG_PASSWORD>`
- `COINAPI_KEY` = your CoinAPI key (get one free at coinapi.io — the one hardcoded in the original PHP files is not yours to reuse)

## 4. Deploy

Easiest path is GitHub Actions (SWA sets this up automatically if you create it
via the Portal/`az staticwebapp create` against a repo). Point it at:
- **App location**: `app`
- **API location**: `api`
- **Output location**: *(leave blank — plain HTML, no build step)*

Or deploy directly with the SWA CLI:

```bash
npm install -g @azure/static-web-apps-cli
cd api && npm install && cd ..
swa deploy ./app --api-location ./api --deployment-token <TOKEN_FROM_PORTAL>
```

## Local development

```bash
cd api
cp local.settings.json.example local.settings.json   # fill in real values
npm install
func start
```

In another terminal:

```bash
swa start ./app --api-location http://localhost:7071
```

This serves the frontend and proxies `/api/*` to your local Functions host,
matching production routing exactly.

## Next steps worth knowing about

- **Auth**: `sessionStorage` + a returned `clientId` is enough to demo the app,
  but nothing stops someone from editing `clientId` in devtools and viewing
  another user's wallet — the API doesn't verify the caller owns that id. For
  anything beyond a demo, add [Static Web Apps built-in
  authentication](https://learn.microsoft.com/azure/static-web-apps/authentication-authorization)
  or issue/verify a signed token in `/api/login` and check it in every other
  function.
- **Transaction history UI**: the `transaction` table is populated by
  `/api/trade` but there's no page listing it yet — same as the original app's
  `active.php`, which wasn't included in the uploaded zip.
- Original `results.php`, `notify.php`, `conver.php`, `assist.php`,
  `homepagetrial.php`, `trialpage_*.php` weren't ported — they weren't shown in
  what was uploaded, or looked like in-progress scratch files. Let me know if
  you need any of those rebuilt too.
