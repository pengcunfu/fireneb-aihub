import { ref } from 'vue'
import { config } from '../data/config'
import { plans as rawPlans } from '../data/plans'

const configState = ref(null)
const plans = ref([])
const loading = ref(true)

export function useData() {
  const loadConfig = async () => {
    // 直接使用导入的配置，无需 fetch
    configState.value = config
  }

  const processPrices = (item, index) => {
    let firstMonthPrice = parseFloat(item.firstMonthPrice)
    let monthlyPrice = parseFloat(item.monthlyPrice)
    let quarterlyPrice = parseFloat(item.quarterlyPrice)
    let yearlyPrice = parseFloat(item.yearlyPrice)

    if (isNaN(firstMonthPrice) || item.firstMonthPrice === '-') {
      firstMonthPrice = monthlyPrice
    }
    if (isNaN(quarterlyPrice) || item.quarterlyPrice === '-') {
      quarterlyPrice = monthlyPrice * 3
    }
    if (isNaN(yearlyPrice) || item.yearlyPrice === '-') {
      yearlyPrice = quarterlyPrice * 3
    }

    return {
      ...item,
      firstMonthPrice,
      monthlyPrice,
      quarterlyPrice,
      yearlyPrice,
      hourlyRequests: typeof item.hourlyRequests === 'string' && item.hourlyRequests === '未公开'
        ? '未公开'
        : parseInt(item.hourlyRequests) || 0,
      monthlyRequests: typeof item.monthlyRequests === 'string' && item.monthlyRequests === '未公开'
        ? '未公开'
        : parseInt(item.monthlyRequests) || 0,
      originalIndex: index
    }
  }

  const loadPlans = async () => {
    // 直接使用导入的数据，无需 fetch
    plans.value = rawPlans.map(processPrices)
    loading.value = false
  }

  const init = async () => {
    await Promise.all([loadConfig(), loadPlans()])
  }

  return {
    config: configState,
    plans,
    loading,
    init
  }
}
