import { ref, computed, watch } from 'vue'

export function useFilters(plansRef) {
  const selectedVendors = ref([])
  const selectedModels = ref([])

  const priceFilters = ref({
    firstMonth: { min: 0, max: 0, applied: false },
    monthly: { min: 0, max: 0, applied: false },
    quarterly: { min: 0, max: 0, applied: false },
    yearly: { min: 0, max: 0, applied: false }
  })

  const sort = ref({ column: null, direction: null })

  // 所有厂商和模型
  const vendors = computed(() => [...new Set(plansRef.value?.map(p => p.vendor) || [])].sort())
  const models = computed(() => [...new Set(plansRef.value?.flatMap(p => p.models) || [])].sort())

  // 筛选后的数据
  const filteredPlans = computed(() => {
    const plans = plansRef.value || []
    let result = [...plans]

    // 厂商筛选
    if (selectedVendors.value.length > 0) {
      result = result.filter(p => selectedVendors.value.includes(p.vendor))
    }

    // 模型筛选
    if (selectedModels.value.length > 0) {
      result = result.filter(p =>
        selectedModels.value.some(m => p.models.includes(m))
      )
    }

    // 价格筛选
    ;['firstMonth', 'monthly', 'quarterly', 'yearly'].forEach(type => {
      const filter = priceFilters.value[type]
      if (filter.applied) {
        const priceKey = type + 'Price'
        if (filter.min > 0) {
          result = result.filter(p => p[priceKey] >= filter.min)
        }
        if (filter.max < filter.max) {
          result = result.filter(p => p[priceKey] <= filter.max)
        }
      }
    })

    // 排序
    if (sort.value.column) {
      result.sort((a, b) => {
        let aVal = a[sort.value.column]
        let bVal = b[sort.value.column]

        if (typeof aVal === 'number') {
          return sort.value.direction === 'asc' ? aVal - bVal : bVal - aVal
        }
        return sort.value.direction === 'asc'
          ? aVal.localeCompare(bVal, 'zh-CN')
          : bVal.localeCompare(aVal, 'zh-CN')
      })
    }

    return result
  })

  const hasFilter = computed(() => {
    return selectedVendors.value.length > 0 ||
      selectedModels.value.length > 0 ||
      Object.values(priceFilters.value).some(f => f.applied)
  })

  // 方法
  const resetVendorFilter = () => {
    selectedVendors.value = []
  }

  const resetModelFilter = () => {
    selectedModels.value = []
  }

  const hasPriceFilter = (type) => {
    const filter = priceFilters.value[type]
    return filter.applied && (filter.min > 0 || filter.max < filter.max)
  }

  const resetPriceFilter = (type) => {
    priceFilters.value[type].min = 0
    priceFilters.value[type].max = priceFilters.value[type].max
    priceFilters.value[type].applied = false
  }

  const applyPriceFilter = (type) => {
    priceFilters.value[type].applied = true
  }

  const resetAllFilters = () => {
    resetVendorFilter()
    resetModelFilter()
    ;['firstMonth', 'monthly', 'quarterly', 'yearly'].forEach(type => {
      resetPriceFilter(type)
    })
    sort.value = { column: null, direction: null }
  }

  const sortBy = (column) => {
    if (sort.value.column === column) {
      if (sort.value.direction === 'asc') {
        sort.value.direction = 'desc'
      } else if (sort.value.direction === 'desc') {
        sort.value = { column: null, direction: null }
      }
    } else {
      sort.value = { column, direction: 'asc' }
    }
  }

  const getSortClass = (column) => {
    if (sort.value.column !== column) return ''
    return sort.value.direction === 'asc' ? 'sort-asc' : 'sort-desc'
  }

  return {
    selectedVendors,
    selectedModels,
    priceFilters,
    sort,
    vendors,
    models,
    filteredPlans,
    hasFilter,
    resetVendorFilter,
    resetModelFilter,
    hasPriceFilter,
    resetPriceFilter,
    applyPriceFilter,
    resetAllFilters,
    sortBy,
    getSortClass
  }
}
