<template>
  <div class="plans-grid">
    <div
      v-for="plan in plans"
      :key="plan.originalIndex"
      class="plan-card"
    >
      <!-- 卡片头部：平台和套餐 -->
      <div class="card-header">
        <div class="platform-badge">{{ plan.vendor }}</div>
        <h3 class="plan-name">{{ plan.plan }}</h3>
      </div>

      <!-- 价格区域 -->
      <div class="price-section">
        <div class="price-row" v-if="plan.firstMonthPrice !== plan.monthlyPrice">
          <span class="price-label">首月</span>
          <span class="price-value price-green">¥{{ formatPrice(plan.firstMonthPrice) }}</span>
        </div>
        <div class="price-row">
          <span class="price-label">包月</span>
          <span class="price-value price-primary">¥{{ formatPrice(plan.monthlyPrice) }}</span>
        </div>
        <div class="price-row" v-if="plan.quarterlyPrice && plan.quarterlyPrice !== '-'">
          <span class="price-label">包季</span>
          <span class="price-value">
            ¥{{ formatPrice(plan.quarterlyPrice) }}
            <span class="price-original" v-if="plan.monthlyPrice * 3 !== plan.quarterlyPrice">¥{{ formatPrice(plan.monthlyPrice * 3) }}</span>
          </span>
        </div>
        <div class="price-row" v-if="plan.yearlyPrice && plan.yearlyPrice !== '-'">
          <span class="price-label">包年</span>
          <span class="price-value">
            ¥{{ formatPrice(plan.yearlyPrice) }}
            <span class="price-original" v-if="plan.monthlyPrice * 12 !== plan.yearlyPrice">¥{{ formatPrice(plan.monthlyPrice * 12) }}</span>
          </span>
        </div>
      </div>

      <!-- 模型标签 -->
      <div class="models-section">
        <div class="section-label">支持模型</div>
        <div class="tags">
          <span class="model-tag" v-for="model in plan.models" :key="model">{{ model }}</span>
        </div>
      </div>

      <!-- 请求数 -->
      <div class="requests-section">
        <div class="request-item">
          <span class="request-label">5小时</span>
          <span class="request-value">{{ formatNumber(plan.hourlyRequests) }}</span>
        </div>
        <div class="request-item">
          <span class="request-label">每月</span>
          <span class="request-value">{{ formatNumber(plan.monthlyRequests) }}</span>
        </div>
      </div>

      <!-- 权益 -->
      <div class="benefits-section" v-if="plan.benefits.length > 0">
        <div class="tags">
          <span class="benefit-tag" v-for="benefit in plan.benefits" :key="benefit">
            {{ benefit }}
          </span>
        </div>
      </div>

      <!-- 备注 -->
      <div class="note-section" v-if="plan.note">
        {{ plan.note }}
      </div>

      <!-- 操作按钮 -->
      <div class="card-actions">
        <a :href="plan.action" target="_blank" class="action-btn">
          查看详情
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { formatPrice, formatNumber } from '../utils/format'

defineProps({
  plans: Array
})
</script>

<style scoped>
.plans-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 20px;
}

.plan-card {
  background: var(--bg-secondary);
  border: 1px solid var(--border-color);
  border-radius: var(--radius-xl);
  padding: 20px;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
}

.plan-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-lg);
  border-color: var(--accent-primary);
}

/* 卡片头部 */
.card-header {
  margin-bottom: 16px;
}

.platform-badge {
  display: inline-block;
  background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
  color: white;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: var(--radius-sm);
  margin-bottom: 8px;
}

.plan-name {
  font-size: 18px;
  font-weight: 700;
  color: var(--text-primary);
  line-height: 1.3;
}

/* 价格区域 */
.price-section {
  background: var(--bg-tertiary);
  border-radius: var(--radius-lg);
  padding: 16px;
  margin-bottom: 16px;
}

.price-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 6px 0;
}

.price-row:not(:last-child) {
  border-bottom: 1px solid var(--border-color);
}

.price-label {
  font-size: 13px;
  color: var(--text-secondary);
}

.price-value {
  font-size: 16px;
  font-weight: 600;
}

.price-green {
  color: #00a855;
}

.price-primary {
  color: var(--accent-primary);
}

.price-original {
  font-size: 12px;
  color: var(--text-tertiary);
  text-decoration: line-through;
  margin-left: 8px;
  font-weight: 400;
}

/* 模型区域 */
.models-section {
  margin-bottom: 16px;
}

.section-label {
  font-size: 12px;
  color: var(--text-tertiary);
  margin-bottom: 8px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.model-tag {
  display: inline-block;
  background: var(--bg-tertiary);
  color: var(--text-secondary);
  padding: 4px 10px;
  border-radius: var(--radius-sm);
  font-size: 11px;
  border: 1px solid var(--border-color);
}

.benefit-tag {
  display: inline-block;
  background: linear-gradient(135deg, rgba(249, 115, 22, 0.08), rgba(251, 146, 60, 0.08));
  color: #f97316;
  padding: 4px 10px;
  border-radius: var(--radius-sm);
  font-size: 11px;
  border: 1px solid rgba(249, 115, 22, 0.15);
}

/* 请求数区域 */
.requests-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 16px;
}

.request-item {
  background: var(--bg-tertiary);
  border-radius: var(--radius-md);
  padding: 12px;
  text-align: center;
}

.request-label {
  display: block;
  font-size: 12px;
  color: var(--text-tertiary);
  margin-bottom: 4px;
}

.request-value {
  font-size: 18px;
  font-weight: 600;
  color: var(--text-primary);
}

/* 权益区域 */
.benefits-section {
  margin-bottom: 16px;
}

/* 备注 */
.note-section {
  font-size: 12px;
  color: var(--text-secondary);
  line-height: 1.5;
  margin-bottom: 16px;
  flex: 1;
}

/* 操作按钮 */
.card-actions {
  margin-top: auto;
}

.action-btn {
  display: block;
  text-align: center;
  background: #0099cc;
  color: white;
  text-decoration: none;
  padding: 12px 20px;
  border-radius: var(--radius-md);
  font-weight: 500;
  transition: all 0.2s;
}

.action-btn:hover {
  background: #0088b8;
  transform: translateY(-1px);
}

/* 响应式 */
@media (max-width: 768px) {
  .plans-grid {
    grid-template-columns: 1fr;
  }

  .price-value {
    font-size: 14px;
  }

  .request-value {
    font-size: 16px;
  }
}
</style>
