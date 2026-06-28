<template>
  <div class="filter-bar" v-if="priceRanges">
    <!-- 平台筛选 -->
    <FilterDropdown
      :label="config?.filters?.vendor || '平台'"
      :show-count="selectedVendors.length > 0"
      :count="selectedVendors.length"
      ref="vendorDropdown"
    >
      <div class="dropdown-section">
        <CheckboxGroup :items="vendors" v-model="selectedVendors" />
      </div>
      <div class="dropdown-actions">
        <button class="dropdown-btn secondary" @click="resetVendorFilter">
          {{ config?.filters?.reset || '重置' }}
        </button>
        <button class="dropdown-btn primary" @click="closeDropdown('vendor')">
          {{ config?.priceFilter?.apply || '确定' }}
        </button>
      </div>
    </FilterDropdown>

    <!-- 首月价格 -->
    <FilterDropdown
      :label="config?.filters?.firstMonthPrice || '首月价格'"
      :show-count="hasPriceFilter('firstMonth')"
      count="●"
      ref="firstMonthDropdown"
    >
      <div class="dropdown-section">
        <div class="dropdown-title">{{ config?.priceFilter?.title || '价格区间 (元)' }}</div>
        <PriceSlider
          v-model:min="priceFilters.firstMonth.min"
          v-model:max="priceFilters.firstMonth.max"
          :max-value="priceRanges.firstMonth.max"
        />
      </div>
      <div class="dropdown-actions">
        <button class="dropdown-btn secondary" @click="resetPriceFilter('firstMonth')">
          {{ config?.priceFilter?.reset || '重置' }}
        </button>
        <button class="dropdown-btn primary" @click="applyPriceFilter('firstMonth'); closeDropdown('firstMonth')">
          {{ config?.priceFilter?.apply || '确定' }}
        </button>
      </div>
    </FilterDropdown>

    <!-- 包月价格 -->
    <FilterDropdown
      :label="config?.filters?.monthlyPrice || '包月价格'"
      :show-count="hasPriceFilter('monthly')"
      count="●"
      ref="monthlyDropdown"
    >
      <div class="dropdown-section">
        <div class="dropdown-title">{{ config?.priceFilter?.title || '价格区间 (元)' }}</div>
        <PriceSlider
          v-model:min="priceFilters.monthly.min"
          v-model:max="priceFilters.monthly.max"
          :max-value="priceRanges.monthly.max"
        />
      </div>
      <div class="dropdown-actions">
        <button class="dropdown-btn secondary" @click="resetPriceFilter('monthly')">
          {{ config?.priceFilter?.reset || '重置' }}
        </button>
        <button class="dropdown-btn primary" @click="applyPriceFilter('monthly'); closeDropdown('monthly')">
          {{ config?.priceFilter?.apply || '确定' }}
        </button>
      </div>
    </FilterDropdown>

    <!-- 包季价格 -->
    <FilterDropdown
      :label="config?.filters?.quarterlyPrice || '包季价格'"
      :show-count="hasPriceFilter('quarterly')"
      count="●"
      ref="quarterlyDropdown"
    >
      <div class="dropdown-section">
        <div class="dropdown-title">{{ config?.priceFilter?.title || '价格区间 (元)' }}</div>
        <PriceSlider
          v-model:min="priceFilters.quarterly.min"
          v-model:max="priceFilters.quarterly.max"
          :max-value="priceRanges.quarterly.max"
        />
      </div>
      <div class="dropdown-actions">
        <button class="dropdown-btn secondary" @click="resetPriceFilter('quarterly')">
          {{ config?.priceFilter?.reset || '重置' }}
        </button>
        <button class="dropdown-btn primary" @click="applyPriceFilter('quarterly'); closeDropdown('quarterly')">
          {{ config?.priceFilter?.apply || '确定' }}
        </button>
      </div>
    </FilterDropdown>

    <!-- 包年价格 -->
    <FilterDropdown
      :label="config?.filters?.yearlyPrice || '包年价格'"
      :show-count="hasPriceFilter('yearly')"
      count="●"
      ref="yearlyDropdown"
    >
      <div class="dropdown-section">
        <div class="dropdown-title">{{ config?.priceFilter?.title || '价格区间 (元)' }}</div>
        <PriceSlider
          v-model:min="priceFilters.yearly.min"
          v-model:max="priceFilters.yearly.max"
          :max-value="priceRanges.yearly.max"
        />
      </div>
      <div class="dropdown-actions">
        <button class="dropdown-btn secondary" @click="resetPriceFilter('yearly')">
          {{ config?.priceFilter?.reset || '重置' }}
        </button>
        <button class="dropdown-btn primary" @click="applyPriceFilter('yearly'); closeDropdown('yearly')">
          {{ config?.priceFilter?.apply || '确定' }}
        </button>
      </div>
    </FilterDropdown>

    <!-- 模型筛选 -->
    <FilterDropdown
      :label="config?.filters?.model || '模型'"
      :show-count="selectedModels.length > 0"
      :count="selectedModels.length"
      ref="modelDropdown"
    >
      <div class="dropdown-section">
        <CheckboxGroup :items="models" v-model="selectedModels" />
      </div>
      <div class="dropdown-actions">
        <button class="dropdown-btn secondary" @click="resetModelFilter">
          {{ config?.filters?.reset || '重置' }}
        </button>
        <button class="dropdown-btn primary" @click="closeDropdown('model')">
          {{ config?.priceFilter?.apply || '确定' }}
        </button>
      </div>
    </FilterDropdown>

    <!-- 重置按钮 -->
    <button class="reset-btn" @click="resetAllFilters">
      {{ config?.filters?.reset || '重置筛选' }}
    </button>

    <!-- 统计 -->
    <div class="stats-bar">
      <span v-html="(config?.filters?.stats || '显示 {showing} / {total} 个套餐')
        .replace('{showing}', `<strong>${filteredPlans.length}</strong>`)
        .replace('{total}', `<strong>${plans.length}</strong>`)">
      </span>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { useData } from '../composables/useData'
import { useFilters } from '../composables/useFilters'
import FilterDropdown from './FilterDropdown.vue'
import CheckboxGroup from './CheckboxGroup.vue'
import PriceSlider from './PriceSlider.vue'

const props = defineProps({
  plans: Array,
  priceRanges: Object
})

const emit = defineEmits(['calculateRanges'])

const { config } = useData()

const {
  selectedVendors,
  selectedModels,
  priceFilters,
  vendors,
  models,
  filteredPlans,
  resetVendorFilter,
  resetModelFilter,
  hasPriceFilter,
  resetPriceFilter,
  applyPriceFilter,
  resetAllFilters
} = useFilters(computed(() => props.plans))

const dropdowns = ref({})

const closeDropdown = (name) => {
  dropdowns.value[name]?.close()
}

const handleClickOutside = () => {
  Object.values(dropdowns.value).forEach(d => d?.close())
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<style scoped>
.filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  align-items: center;
  margin-bottom: 20px;
}

.dropdown-section {
  margin-bottom: 16px;
}

.dropdown-section:last-child {
  margin-bottom: 0;
}

.dropdown-title {
  font-size: 12px;
  color: var(--text-tertiary);
  margin-bottom: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.dropdown-actions {
  display: flex;
  gap: 10px;
  margin-top: 16px;
  padding-top: 16px;
  border-top: 1px solid var(--border-light);
}

.dropdown-btn {
  flex: 1;
  padding: 10px 16px;
  border: none;
  border-radius: var(--radius-md);
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
  font-weight: 600;
}

.dropdown-btn.primary {
  background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
  color: white;
}

.dropdown-btn.primary:hover {
  transform: translateY(-1px);
}

.dropdown-btn.secondary {
  background: var(--bg-tertiary);
  color: var(--text-secondary);
  border: 1px solid var(--border-color);
}

.dropdown-btn.secondary:hover {
  background: var(--border-color);
}

.reset-btn {
  background: var(--bg-secondary);
  border: 1px solid var(--border-color);
  color: var(--text-secondary);
  padding: 10px 16px;
  border-radius: var(--radius-lg);
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
  font-weight: 500;
  box-shadow: var(--shadow-sm);
  min-height: 40px;
}

.reset-btn:hover {
  background: var(--bg-tertiary);
  border-color: var(--text-tertiary);
}

.stats-bar {
  color: var(--text-tertiary);
  font-size: 12px;
  display: flex;
  align-items: center;
  margin-left: auto;
}
</style>
