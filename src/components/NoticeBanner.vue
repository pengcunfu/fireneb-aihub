<template>
  <div class="notice-banner-wrapper">
    <div class="notice-banner">
      <span class="icon">⚠️</span>
      <span>{{ text }}</span>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useData } from '../composables/useData'

const { config } = useData()
const text = computed(() => config.value?.notice?.text || '本页面数据仅供参考，价格及权益最终以平台官方公布为准')
</script>

<style scoped>
.notice-banner-wrapper {
  text-align: center;
  margin-bottom: 24px;
}

.notice-banner {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(139, 92, 246, 0.08));
  border: 1px solid rgba(99, 102, 241, 0.2);
  color: var(--accent-primary);
  padding: 12px 20px;
  border-radius: var(--radius-lg);
  font-size: 13px;
  font-weight: 500;
  backdrop-filter: blur(10px);
}
</style>
