<template>
  <div class="plans-container" v-if="!loading">
    <!-- 视图切换按钮 -->
    <div class="view-toggle">
      <button
        class="toggle-btn"
        :class="{ active: viewMode === 'table' }"
        @click="viewMode = 'table'"
      >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="18" height="18" rx="2" />
          <line x1="3" y1="9" x2="21" y2="9" />
          <line x1="3" y1="15" x2="21" y2="15" />
          <line x1="9" y1="3" x2="9" y2="21" />
          <line x1="15" y1="3" x2="15" y2="21" />
        </svg>
        <span>表格</span>
      </button>
      <button
        class="toggle-btn"
        :class="{ active: viewMode === 'card' }"
        @click="viewMode = 'card'"
      >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1" />
          <rect x="14" y="3" width="7" height="7" rx="1" />
          <rect x="3" y="14" width="7" height="7" rx="1" />
          <rect x="14" y="14" width="7" height="7" rx="1" />
        </svg>
        <span>卡片</span>
      </button>
    </div>

    <!-- 空状态 -->
    <div v-if="filteredPlans.length === 0" class="empty-state">
      <div class="empty-state-icon">📭</div>
      <div class="empty-state-text">没有找到符合条件的套餐</div>
      <div class="empty-state-hint">请调整筛选条件或重置筛选</div>
    </div>

    <!-- 表格视图 -->
    <TableView v-else-if="viewMode === 'table'" :plans="filteredPlans" />

    <!-- 卡片视图 -->
    <CardView v-else :plans="filteredPlans" />
  </div>

  <div class="loading" v-else>加载数据中...</div>
</template>

<script setup>
import { useData } from '../composables/useData'
import TableView from './TableView.vue'
import CardView from './CardView.vue'

defineProps({
  filteredPlans: Array
})

defineEmits(['update:viewMode'])

const { loading } = useData()
const viewMode = defineModel('viewMode', { type: String, default: 'table' })
</script>

<style scoped>
.plans-container {
  min-height: 400px;
}

.view-toggle {
  display: flex;
  gap: 8px;
  margin-bottom: 20px;
  justify-content: flex-end;
}

.toggle-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--bg-secondary);
  border: 1px solid var(--border-color);
  color: var(--text-secondary);
  padding: 8px 16px;
  border-radius: var(--radius-md);
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
  font-weight: 500;
}

.toggle-btn:hover {
  background: var(--bg-tertiary);
  border-color: var(--accent-primary);
  color: var(--text-primary);
}

.toggle-btn.active {
  background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
  border-color: var(--accent-primary);
  color: white;
}

.toggle-btn svg {
  width: 16px;
  height: 16px;
}

.empty-state {
  text-align: center;
  padding: 80px 24px;
  color: var(--text-tertiary);
}

.empty-state-icon {
  font-size: 48px;
  margin-bottom: 16px;
  opacity: 0.4;
}

.empty-state-text {
  color: var(--text-secondary);
  font-size: 15px;
  font-weight: 500;
  margin-bottom: 8px;
}

.empty-state-hint {
  font-size: 13px;
}

.loading {
  text-align: center;
  padding: 80px 24px;
  color: var(--text-secondary);
}
</style>
