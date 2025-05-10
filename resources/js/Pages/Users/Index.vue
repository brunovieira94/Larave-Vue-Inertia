<template>
  <Layout>
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Users Dashboard</h1>
        <Link href="/users/create" class="btn btn-primary">
          <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New User
          </span>
        </Link>
      </div>

      <!-- Results Counter -->
      <div class="flex justify-between items-center">
        <div class="text-sm text-gray-500">
          Showing {{ users.from }}-{{ users.to }} of {{ users.total }} results
        </div>
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-2">
            <label class="text-sm text-gray-600">Per Page:</label>
            <select
              v-model="filters.per_page"
              @change="updateFilters"
              class="select w-20"
            >
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
          <button
            @click="clearFilters"
            class="btn btn-secondary text-sm"
            v-if="hasActiveFilters"
          >
            <span class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
              Clear Filters
            </span>
          </button>
        </div>
      </div>

      <!-- Filters -->
      <div class="card space-y-4">
        <div class="flex gap-4">
          <div class="flex-1">
            <input
              v-model="search"
              type="text"
              placeholder="Search users..."
              class="input"
              @keyup.enter="handleSearch"
            />
          </div>
          <button
            @click="handleSearch"
            class="btn btn-primary"
            :disabled="processing"
          >
            <span class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
              Search
            </span>
          </button>
        </div>

        <div class="grid grid-cols-3 gap-6">
          <!-- Coluna 1: País e Cidade -->
          <div class="space-y-4">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
              <select
                v-model="filters.country"
                @change="handleCountryChange"
                class="w-full select min-w-[200px]"
              >
                <option value="">All Countries</option>
                <option v-for="country in countries" :key="country" :value="country">
                  {{ country }}
                </option>
              </select>
            </div>

            <div class="w-full" v-show="filters.country">
              <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
              <select
                v-model="filters.city"
                @change="updateFilters"
                class="w-full select min-w-[200px]"
              >
                <option value="">All Cities</option>
                <option v-for="city in cities" :key="city" :value="city">
                  {{ city }}
                </option>
              </select>
            </div>
          </div>

          <!-- Coluna 2: Sort By -->
          <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
            <select
              v-model="filters.sort"
              @change="updateFilters"
              class="w-full select min-w-[200px]"
            >
              <option value="created_at">Date Created</option>
              <option value="name">Name</option>
              <option value="email">Email</option>
            </select>
          </div>

          <!-- Coluna 3: Order -->
          <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
            <select
              v-model="filters.order"
              @change="updateFilters"
              class="w-full select min-w-[200px]"
            >
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="processing" class="card py-12">
        <Loading text="Searching users..." />
      </div>

      <!-- Results -->
      <div v-else-if="users.data.length === 0" class="card text-center py-12">
        <p class="text-gray-500">No users found.</p>
      </div>

      <div v-else class="card overflow-hidden">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-50 border-b">
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Name</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Email</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Country</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">City</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-50">
              <td class="px-6 py-4">{{ user.first_name }} {{ user.last_name }}</td>
              <td class="px-6 py-4">{{ user.email }}</td>
              <td class="px-6 py-4">{{ user.address?.country }}</td>
              <td class="px-6 py-4">{{ user.address?.city }}</td>
              <td class="px-6 py-4">
                <div class="flex gap-2">
                  <Link
                    :href="`/users/${user.id}`"
                    class="text-blue-600 hover:text-blue-800"
                  >
                    View
                  </Link>
                  <Link
                    :href="`/users/${user.id}/edit`"
                    class="text-green-600 hover:text-green-800"
                  >
                    Edit
                  </Link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <Pagination :links="users.links" class="mt-6" />
    </div>
  </Layout>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Layout from '../../Layouts/Layout.vue'
import Pagination from '../../Components/Pagination.vue'
import Loading from '../../Components/Loading.vue'

const props = defineProps({
  users: Object,
  filters: Object,
  countries: Array,
  cities: {
    type: Array,
    default: () => []
  }
})

const search = ref(props.filters.search)
const processing = ref(false)
const filters = reactive({
  search: props.filters.search || '',
  country: props.filters.country || '',
  city: props.filters.city || '',
  sort: props.filters.sort || 'created_at',
  order: props.filters.order || 'desc',
  per_page: props.filters.per_page || '10'
})

const hasActiveFilters = computed(() => {
  return filters.search ||
         filters.country ||
         filters.city ||
         filters.sort !== 'created_at' ||
         filters.order !== 'desc' ||
         filters.per_page !== '10'
})

const handleSearch = () => {
  filters.search = search.value
  updateFilters()
}

const handleCountryChange = () => {
  filters.city = '' // Clear city when country changes
  updateFilters()
}

const clearFilters = () => {
  search.value = ''
  filters.search = ''
  filters.country = ''
  filters.city = ''
  filters.sort = 'created_at'
  filters.order = 'desc'
  filters.per_page = '10'
  updateFilters()
}

const updateFilters = () => {
  processing.value = true
  router.get('/users', filters, {
    preserveState: true,
    preserveScroll: true,
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>
