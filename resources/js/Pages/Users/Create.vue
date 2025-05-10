<template>
  <Layout>
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Create User</h1>
        <Link
          href="/users"
          class="btn btn-secondary"
        >
          <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back
          </span>
        </Link>
      </div>

      <!-- Form -->
      <form @submit.prevent="submit" class="grid md:grid-cols-2 gap-6">
        <div class="card space-y-6">
          <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <input
                  v-model="form.first_name"
                  type="text"
                  class="input"
                  :class="{ 'border-red-500': form.errors.first_name }"
                />
                <p v-if="form.errors.first_name" class="mt-1 text-sm text-red-600">
                  {{ form.errors.first_name }}
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                <input
                  v-model="form.last_name"
                  type="text"
                  class="input"
                  :class="{ 'border-red-500': form.errors.last_name }"
                />
                <p v-if="form.errors.last_name" class="mt-1 text-sm text-red-600">
                  {{ form.errors.last_name }}
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input
                  v-model="form.email"
                  type="email"
                  class="input"
                  :class="{ 'border-red-500': form.errors.email }"
                />
                <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">
                  {{ form.errors.email }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="card space-y-6">
          <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h2>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Country</label>
                <input
                  v-model="form.address.country"
                  type="text"
                  class="input"
                  :class="{ 'border-red-500': form.errors['address.country'] }"
                />
                <p v-if="form.errors['address.country']" class="mt-1 text-sm text-red-600">
                  {{ form.errors['address.country'] }}
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">City</label>
                <input
                  v-model="form.address.city"
                  type="text"
                  class="input"
                  :class="{ 'border-red-500': form.errors['address.city'] }"
                />
                <p v-if="form.errors['address.city']" class="mt-1 text-sm text-red-600">
                  {{ form.errors['address.city'] }}
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Post Code</label>
                <input
                  v-model="form.address.post_code"
                  type="text"
                  class="input"
                  :class="{ 'border-red-500': form.errors['address.post_code'] }"
                />
                <p v-if="form.errors['address.post_code']" class="mt-1 text-sm text-red-600">
                  {{ form.errors['address.post_code'] }}
                </p>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Street</label>
                <input
                  v-model="form.address.street"
                  type="text"
                  class="input"
                  :class="{ 'border-red-500': form.errors['address.street'] }"
                />
                <p v-if="form.errors['address.street']" class="mt-1 text-sm text-red-600">
                  {{ form.errors['address.street'] }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="flex justify-end gap-2">
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="form.processing"
            >
              Create User
            </button>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import Layout from '../../Layouts/Layout.vue'

const form = useForm({
  first_name: '',
  last_name: '',
  email: '',
  address: {
    country: '',
    city: '',
    post_code: '',
    street: ''
  }
})

const submit = () => {
  form.post('/users')
}
</script>
