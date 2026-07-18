// Shared helpers used by every page.
// Azure Static Web Apps automatically proxies /api/* to the linked Functions app,
// both locally (via `swa start`) and in production - no base URL needed.

const API_BASE = '/api';

async function apiFetch(path, options = {}) {
  const res = await fetch(`${API_BASE}${path}`, {
    headers: { 'Content-Type': 'application/json' },
    ...options
  });
  const body = await res.json().catch(() => ({}));
  if (!res.ok) {
    throw new Error(body.error || `Request failed (${res.status})`);
  }
  return body;
}

// Very simple client-side session: we store the logged-in clientId + name in
// sessionStorage after login. This mirrors the original app's ?id= pattern but
// keeps it out of the URL. For a real production app, swap this for Azure
// Static Web Apps built-in authentication or a signed JWT issued by /api/login.
const Session = {
  KEY: 'cryptojet_session',
  set(data) { sessionStorage.setItem(this.KEY, JSON.stringify(data)); },
  get() {
    const raw = sessionStorage.getItem(this.KEY);
    return raw ? JSON.parse(raw) : null;
  },
  clear() { sessionStorage.removeItem(this.KEY); },
  requireLogin() {
    const s = this.get();
    if (!s) window.location.href = '/login.html';
    return s;
  }
};

function fmtUsd(n) {
  return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n || 0);
}
