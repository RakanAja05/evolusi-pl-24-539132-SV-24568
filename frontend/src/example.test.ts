import { describe, it, expect, vi, beforeEach } from 'vitest'
import { mount } from '@vue/test-utils'
import { nextTick } from 'vue'
import TugasList from './pages/TugasList.vue'

// Mock fetch globally
global.fetch = vi.fn()

describe('TugasList component', () => {
  beforeEach(() => {
    vi.clearAllMocks()
  })

  it('shows loading initially', async () => {
    const fetchPromise = Promise.resolve({
      ok: true,
      json: () => Promise.resolve([]),
    })
    ;(global.fetch as vi.Mock).mockReturnValue(fetchPromise)

    const wrapper = mount(TugasList)
    await nextTick()

    expect(wrapper.find('.loading').exists()).toBe(true)
  })

  it('shows error when fetch fails', async () => {
    const fetchPromise = Promise.resolve({
      ok: false,
      status: 500,
    })
    ;(global.fetch as vi.Mock).mockReturnValue(fetchPromise)

    const wrapper = mount(TugasList)
    await nextTick()
    await nextTick()

    expect(wrapper.find('.error').exists()).toBe(true)
  })

  it('displays tugas items after successful fetch', async () => {
    const mockTugas = [
      { id: 1, title: 'Test Tugas 1', description: 'Deskripsi 1', status: 'pending', created_at: '2024-01-01' },
    ]

    const fetchPromise = Promise.resolve({
      ok: true,
      json: () => Promise.resolve(mockTugas),
    })
    ;(global.fetch as vi.Mock).mockReturnValue(fetchPromise)

    const wrapper = mount(TugasList)
    await nextTick()
    await nextTick()
    await nextTick()

    expect(wrapper.find('.loading').exists()).toBe(false)
    expect(wrapper.find('.error').exists()).toBe(false)
    expect(wrapper.find('.empty').exists()).toBe(false)
    expect(wrapper.findAll('tbody tr')).toHaveLength(1)
    expect(wrapper.text()).toContain('Test Tugas 1')
  })

  it('formats date correctly', () => {
    const date = new Date('2024-01-15T10:30:00Z')
    const formatted = date.toLocaleDateString('id-ID', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    })
    expect(formatted).toMatch(/15 Januari 2024/)
  })
})

