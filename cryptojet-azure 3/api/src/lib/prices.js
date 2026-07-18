const COINS = ['BTC', 'LTC', 'ETH', 'XRP', 'USDC', 'XMR'];

let cache = { data: null, expires: 0 };
const CACHE_TTL_MS = 30 * 1000; // 30s - avoid hammering CoinAPI on every request

async function getPrices(context) {
    const now = Date.now();
    if (cache.data && cache.expires > now) {
        return cache.data;
    }

    const apiKey = process.env.COINAPI_KEY;
    const prices = {};

    await Promise.all(COINS.map(async (coin) => {
        try {
            const res = await fetch(`https://rest.coinapi.io/v1/exchangerate/${coin}/USD`, {
                headers: { 'X-CoinAPI-Key': apiKey }
            });
            if (!res.ok) throw new Error(`CoinAPI ${coin} returned ${res.status}`);
            const json = await res.json();
            prices[coin] = json.rate || 0;
        } catch (err) {
            context && context.error(`Price fetch failed for ${coin}: ${err.message}`);
            prices[coin] = 0;
        }
    }));

    cache = { data: prices, expires: now + CACHE_TTL_MS };
    return prices;
}

module.exports = { getPrices, COINS };
