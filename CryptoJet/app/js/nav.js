function renderNav(activePage) {
  const mount = document.getElementById('topbar');
  if (!mount) return;

  const session = Session.get();
  const tabs = session
    ? `
      <nav class="tabs">
        <a href="/index.html" class="${activePage === 'home' ? 'active' : ''}">Home</a>
        <a href="/wallet.html" class="${activePage === 'wallet' ? 'active' : ''}">Wallet</a>
        <a href="/trade.html" class="${activePage === 'trade' ? 'active' : ''}">Trade</a>
        <a href="/admin.html" class="${activePage === 'admin' ? 'active' : ''}">Account</a>
        <a href="#" id="signOutLink">Sign out</a>
      </nav>`
    : `
      <nav class="tabs">
        <a href="/login.html" class="${activePage === 'login' ? 'active' : ''}">Login</a>
        <a href="/register.html" class="${activePage === 'register' ? 'active' : ''}">Create account</a>
      </nav>`;

  mount.innerHTML = `
    <a class="brand" href="/index.html">
      <img class="logo" src="/extra/jet.ico" alt="" />
      CryptoJet
    </a>
    ${tabs}
  `;

  const signOut = document.getElementById('signOutLink');
  if (signOut) {
    signOut.addEventListener('click', (e) => {
      e.preventDefault();
      Session.clear();
      window.location.href = '/login.html';
    });
  }
}
