<template>
  <header class="header">
    <h1>{{ headerConfig?.title || 'AI Coding Plan 对比' }}</h1>
    <div class="update-date">{{ headerConfig?.updateDate || '' }}</div>
    <div class="subtitle">{{ headerConfig?.subtitle || '' }}</div>
    <div class="models">{{ headerConfig?.models || '' }}</div>
  </header>
</template>

<script setup>
import { computed } from 'vue'
import { useData } from '../composables/useData'

const { config } = useData()
const headerConfig = computed(() => config.value?.header)
</script>

<style scoped>
.header {
  margin-bottom: 48px;
  text-align: center;
  padding: 48px 0;
}

.header h1 {
  font-size: 42px;
  color: var(--text-primary);
  margin-bottom: 12px;
  font-weight: 700;
  letter-spacing: -0.5px;
  line-height: 1.2;
}

.update-date {
  font-size: 14px;
  color: var(--text-tertiary);
  margin-bottom: 20px;
  font-weight: 400;
  letter-spacing: 0.3px;
}

.subtitle {
  color: var(--text-secondary);
  font-size: 18px;
  margin-bottom: 16px;
  font-weight: 500;
  line-height: 1.7;
}

.models {
  color: var(--text-tertiary);
  font-size: 15px;
  font-weight: 400;
  line-height: 1.7;
}

@media (max-width: 768px) {
  .header h1 {
    font-size: 22px;
  }
}
</style>
