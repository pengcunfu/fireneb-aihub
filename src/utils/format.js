export function formatPrice(price) {
  return Number.isInteger(price) ? price.toString() : price.toFixed(2)
}

export function formatNumber(num) {
  return typeof num === 'number' ? num.toLocaleString() : num
}
