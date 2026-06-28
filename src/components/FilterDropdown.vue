<template>
  <div class="filter-dropdown">
    <button
      class="filter-btn"
      :class="{ active: isOpen }"
      @click.stop="toggle"
    >
      <span>{{ label }}</span>
      <span class="arrow" :class="{ rotated: isOpen }">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
      </span>
      <span v-if="showCount" class="count">{{ count }}</span>
    </button>
    <div class="dropdown-menu" v-show="isOpen" @click.stop>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  label: String,
  showCount: Boolean,
  count: [Number, String]
})

const isOpen = ref(false)

const toggle = () => {
  isOpen.value = !isOpen.value
}

const close = () => {
  isOpen.value = false
}

defineExpose({ close })
</script>

<style scoped>
.filter-dropdown {
  position: relative;
}

.filter-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--bg-secondary);
  border: 1px solid var(--border-color);
  color: var(--text-secondary);
  padding: 10px 16px;
  border-radius: var(--radius-lg);
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
  white-space: nowrap;
  font-weight: 500;
  box-shadow: var(--shadow-sm);
  min-height: 40px;
}

.filter-btn:hover {
  background: var(--bg-tertiary);
  border-color: var(--accent-primary);
  color: var(--text-primary);
  transform: translateY(-1px);
}

.filter-btn.active {
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
  border-color: var(--accent-primary);
  color: var(--accent-primary);
}

.arrow {
  width: 14px;
  height: 14px;
  transition: transform 0.3s;
  opacity: 0.5;
}

.arrow.rotated {
  transform: rotate(180deg);
}

.count {
  background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
  color: white;
  font-size: 11px;
  padding: 2px 8px;
  border-radius: 12px;
  min-width: 20px;
  text-align: center;
  font-weight: 600;
}

.dropdown-menu {
  position: absolute;
  top: calc(100% + 8px);
  left: 0;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border: 1px solid var(--border-color);
  border-radius: var(--radius-lg);
  padding: 16px;
  min-width: 280px;
  box-shadow: var(--shadow-xl);
  z-index: 1000;
}
</style>
