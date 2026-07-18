-- CryptoJet schema for Azure SQL Database
-- Run this against your Azure SQL DB before deploying the API.

IF OBJECT_ID('dbo.wallet', 'U') IS NOT NULL DROP TABLE dbo.wallet;
IF OBJECT_ID('dbo.customer', 'U') IS NOT NULL DROP TABLE dbo.customer;
IF OBJECT_ID('dbo.cryptocurrency', 'U') IS NOT NULL DROP TABLE dbo.cryptocurrency;

CREATE TABLE dbo.cryptocurrency (
    cryptoId    INT IDENTITY(1,1) PRIMARY KEY,
    coinCode    VARCHAR(10) NOT NULL UNIQUE,   -- BTC, LTC, ETH, XRP, USDC, XMR
    coinName    VARCHAR(50) NOT NULL
);

INSERT INTO dbo.cryptocurrency (coinCode, coinName) VALUES
    ('BTC', 'Bitcoin'),
    ('LTC', 'Litecoin'),
    ('ETH', 'Ethereum'),
    ('XRP', 'Ripple'),
    ('USDC', 'USD Coin'),
    ('XMR', 'Monero');

CREATE TABLE dbo.customer (
    clientId    INT IDENTITY(1,1) PRIMARY KEY,
    fname       NVARCHAR(50) NOT NULL,
    lname       NVARCHAR(50) NOT NULL,
    username    NVARCHAR(50) NOT NULL UNIQUE,
    passHash    NVARCHAR(200) NOT NULL,        -- bcrypt hash, never plaintext
    email       NVARCHAR(100) NOT NULL,
    phoneNum    NVARCHAR(20) NOT NULL,
    country     NVARCHAR(80) NOT NULL,
    prefCoin    VARCHAR(10) NOT NULL DEFAULT 'BTC',
    createdAt   DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME()
);

CREATE TABLE dbo.wallet (
    walletId    INT IDENTITY(1,1) PRIMARY KEY,
    userId      INT NOT NULL FOREIGN KEY REFERENCES dbo.customer(clientId) ON DELETE CASCADE,
    cryptoId    INT NOT NULL FOREIGN KEY REFERENCES dbo.cryptocurrency(cryptoId),
    balance     DECIMAL(28,10) NOT NULL DEFAULT 0,
    CONSTRAINT UQ_wallet_user_coin UNIQUE (userId, cryptoId)
);

CREATE TABLE dbo.[transaction] (
    transId     INT IDENTITY(1,1) PRIMARY KEY,
    userId      INT NOT NULL FOREIGN KEY REFERENCES dbo.customer(clientId) ON DELETE CASCADE,
    cryptoId    INT NOT NULL FOREIGN KEY REFERENCES dbo.cryptocurrency(cryptoId),
    tranHist    DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME(),
    amountUsd   DECIMAL(28,10) NOT NULL,
    balance     DECIMAL(28,10) NOT NULL,   -- resulting coin balance after the trade
    descrip     VARCHAR(10) NOT NULL,      -- 'BUY' or 'SELL'
    stat        TINYINT NOT NULL DEFAULT 1
);

-- Helper: call this after inserting a new customer to give them a zero-balance
-- wallet row for every coin. The register function does this automatically.

