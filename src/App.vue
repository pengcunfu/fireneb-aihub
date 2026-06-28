<template>
  <div class="app">
    <AppHeader />
    <div class="container">
      <NoticeBanner />
      <FilterBar v-if="priceRanges" :plans="plans" :price-ranges="priceRanges" />
      <PlanTable :plans="plans" :filtered-plans="filteredPlans" />
      <Disclaimer />
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useData } from './composables/useData'
import { useFilters } from './composables/useFilters'
import AppHeader from './components/AppHeader.vue'
import NoticeBanner from './components/NoticeBanner.vue'
import FilterBar from './components/FilterBar.vue'
import PlanTable from './components/PlanTable.vue'
import Disclaimer from './components/Disclaimer.vue'

const { plans: plansData, init } = useData()
const plans = ref([])
const priceRanges = ref(null)

const {
  priceFilters,
  filteredPlans
} = useFilters(plans)

const calculatePriceRanges = () => {
  if (plans.value.length === 0) return
  const types = ['firstMonth', 'monthly', 'quarterly', 'yearly']
  const ranges = {}
  types.forEach(type => {
    const priceKey = type + 'Price'
    const maxVal = Math.max(...plans.value.map(p => p[priceKey]))
    ranges[type] = { max: Math.ceil(maxVal) }
    priceFilters.value[type].max = ranges[type].max
    priceFilters.value[type].min = 0
  })
  priceRanges.value = ranges
}

onMounted(async () => {
  await init()
  plans.value = plansData.value
  calculatePriceRanges()
})
</script>

<style>
.app {
  min-height: 100vh;
  background: var(--bg-primary);
}
</style>
