<template>
  <div class="disclaimer">
    ⚠️ {{ text }}
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useData } from '../composables/useData'

const { config } = useData()
const text = computed(() => config.value?.notice?.text || '本页面数据仅供参考，价格及权益最终以平台官方公布为准')
</script>

<style scoped>
.disclaimer {
  text-align: center;
  margin-top: 32px;
  padding: 20px;
  color: var(--text-tertiary);
  font-size: 12px;
  border-top: 1px solid var(--border-color);
}
</style>
