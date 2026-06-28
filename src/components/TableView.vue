<template>
  <div class="table-wrapper">
    <div class="table-scroll">
      <table>
        <thead>
          <tr>
            <th class="sortable sticky-first" @click="sortBy('vendor')" :class="getSortClass('vendor')">
              {{ config?.table?.columns?.vendor || '平台' }}
            </th>
            <th class="sticky-second">{{ config?.table?.columns?.plan || '套餐' }}</th>
            <th>{{ config?.table?.columns?.action || '跳转链接' }}</th>
            <th class="sortable" @click="sortBy('firstMonthPrice')" :class="getSortClass('firstMonthPrice')">
              {{ config?.table?.columns?.firstMonthPrice || '首月价格' }}
            </th>
            <th class="sortable" @click="sortBy('monthlyPrice')" :class="getSortClass('monthlyPrice')">
              {{ config?.table?.columns?.monthlyPrice || '连续包月' }}
            </th>
            <th class="sortable" @click="sortBy('quarterlyPrice')" :class="getSortClass('quarterlyPrice')">
              {{ config?.table?.columns?.quarterlyPrice || '连续包季' }}
            </th>
            <th class="sortable" @click="sortBy('yearlyPrice')" :class="getSortClass('yearlyPrice')">
              {{ config?.table?.columns?.yearlyPrice || '连续包年' }}
            </th>
            <th>{{ config?.table?.columns?.models || '支持模型' }}</th>
            <th class="sortable" @click="sortBy('hourlyRequests')" :class="getSortClass('hourlyRequests')">
              {{ config?.table?.columns?.hourlyRequests || '5小时请求数' }}
            </th>
            <th class="sortable" @click="sortBy('monthlyRequests')" :class="getSortClass('monthlyRequests')">
              {{ config?.table?.columns?.monthlyRequests || '每月总请求数' }}
            </th>
            <th>{{ config?.table?.columns?.benefits || '其他权益' }}</th>
            <th>{{ config?.table?.columns?.note || '备注' }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="plan in plans" :key="plan.originalIndex">
            <td class="sticky-first"><span class="vendor-name">{{ plan.vendor }}</span></td>
            <td class="sticky-second"><span class="plan-name">{{ plan.plan }}</span></td>
            <td>
              <a :href="plan.action" target="_blank" class="action-btn">
                跳转开通
              </a>
            </td>
            <td><span class="price">¥{{ formatPrice(plan.firstMonthPrice) }} <span class="unit">/ 首月</span></span></td>
            <td><span class="price-monthly">¥{{ formatPrice(plan.monthlyPrice) }} <span class="unit">/ 月</span></span></td>
            <td>
              <span class="price-normal">¥{{ formatPrice(plan.quarterlyPrice) }}
              <span class="price-original" v-if="plan.monthlyPrice * 3 !== plan.quarterlyPrice">{{ formatPrice(plan.monthlyPrice * 3) }}</span>
              <span class="unit">/ 季</span></span>
            </td>
            <td>
              <span class="price-normal">¥{{ formatPrice(plan.yearlyPrice) }}
              <span class="price-original" v-if="plan.monthlyPrice * 12 !== plan.yearlyPrice">{{ formatPrice(plan.monthlyPrice * 12) }}</span>
              <span class="unit">/ 年</span></span>
            </td>
            <td>
              <span class="model-tag" v-for="model in plan.models" :key="model">{{ model }}</span>
            </td>
            <td><span class="request-count">{{ formatNumber(plan.hourlyRequests) }} <span class="unit">/ 5小时</span></span></td>
            <td><span class="request-count">{{ formatNumber(plan.monthlyRequests) }} <span class="unit">/ 月</span></span></td>
            <td>
              <span class="benefit" v-for="benefit in plan.benefits" :key="benefit">{{ benefit }}</span>
            </td>
            <td class="note">{{ plan.note || '' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useData } from '../composables/useData'
import { useFilters } from '../composables/useFilters'
import { formatPrice, formatNumber } from '../utils/format'

const props = defineProps({
  plans: Array
})

const emit = defineEmits(['sort'])

const { config } = useData()

const { sortBy, getSortClass } = useFilters(computed(() => props.plans))
</script>

<style scoped>
.table-wrapper {
  background: var(--bg-secondary);
  border-radius: var(--radius-xl);
  overflow: hidden;
  border: 1px solid var(--border-color);
  box-shadow: var(--shadow-lg);
}

.table-scroll {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  min-width: 1200px;
}

thead {
  background: linear-gradient(135deg, #fafbfc, #f8fafc);
}

th {
  padding: 16px 18px;
  text-align: left;
  font-weight: 600;
  font-size: 12px;
  color: var(--text-secondary);
  white-space: nowrap;
  cursor: pointer;
  user-select: none;
  transition: background 0.2s;
  border-bottom: 2px solid var(--border-light);
  position: relative;
}

th:hover {
  background: var(--bg-tertiary);
  color: var(--text-primary);
}

th.sortable::after {
  content: '';
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 8px;
  vertical-align: middle;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid var(--text-tertiary);
  opacity: 0.4;
}

th.sort-asc::after {
  border-top: none;
  border-bottom: 4px solid var(--accent-primary);
  opacity: 1;
}

th.sort-desc::after {
  border-top: 4px solid var(--accent-primary);
  border-bottom: none;
  opacity: 1;
}

th.sticky-first,
th.sticky-second {
  position: sticky;
  z-index: 20;
  background: linear-gradient(135deg, #fafbfc, #f8fafc);
}

th.sticky-first {
  left: 0;
  border-right: 2px solid var(--border-color);
}

th.sticky-second {
  left: 116px;
  border-right: 2px solid var(--border-color);
}

td {
  padding: 16px 18px;
  border-bottom: 1px solid var(--border-light);
  font-size: 13px;
  white-space: nowrap;
  color: var(--text-primary);
  position: relative;
}

tbody tr:hover {
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.02), rgba(139, 92, 246, 0.02));
}

td.sticky-first,
td.sticky-second {
  position: sticky;
  z-index: 100;
  background: var(--bg-secondary);
}

td.sticky-first {
  left: 0;
  border-right: 2px solid var(--border-color);
}

td.sticky-second {
  left: 116px;
  border-right: 2px solid var(--border-color);
}

tbody tr:hover td.sticky-first,
tbody tr:hover td.sticky-second {
  background: var(--bg-secondary);
  box-shadow: inset 0 0 0 100px rgba(99, 102, 241, 0.02);
}

.vendor-name {
  font-weight: 600;
  font-size: 14px;
}

.plan-name {
  font-weight: 600;
  font-size: 14px;
}

.price {
  color: #00a855;
  font-weight: 500;
}

.price-monthly {
  color: var(--accent-primary);
  font-weight: 500;
}

.price-normal {
  color: var(--text-primary);
  font-weight: 400;
}

.price-original {
  text-decoration: line-through;
  font-size: 12px;
  color: var(--text-tertiary);
  margin-left: 4px;
}

.unit {
  color: var(--text-secondary);
  font-size: 11px;
  margin-left: 4px;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #0099cc;
  color: white;
  text-decoration: none;
  padding: 8px 16px;
  border-radius: var(--radius-md);
  font-weight: 500;
  transition: all 0.2s;
}

.action-btn:hover {
  background: #0088b8;
  transform: translateY(-1px);
}

.model-tag {
  display: inline-block;
  background: var(--bg-tertiary);
  color: var(--text-secondary);
  padding: 4px 10px;
  border-radius: var(--radius-sm);
  font-size: 11px;
  margin-right: 6px;
  margin-bottom: 6px;
  border: 1px solid var(--border-color);
}

.benefit {
  display: inline-block;
  background: linear-gradient(135deg, rgba(249, 115, 22, 0.08), rgba(251, 146, 60, 0.08));
  color: #f97316;
  padding: 4px 10px;
  border-radius: var(--radius-sm);
  font-size: 11px;
  margin-right: 6px;
  margin-bottom: 6px;
  border: 1px solid rgba(249, 115, 22, 0.15);
}

.request-count {
  font-weight: 400;
}

.note {
  color: var(--text-secondary);
}
</style>
