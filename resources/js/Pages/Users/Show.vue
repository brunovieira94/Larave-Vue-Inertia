<template>
  <Layout>
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
        <div class="flex gap-2">
          <Link
            :href="`/users/${user.id}/edit`"
            class="btn btn-primary"
          >
            <span class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
              </svg>
              Edit User
            </span>
          </Link>
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
      </div>

      <!-- User Information -->
      <div class="grid md:grid-cols-2 gap-6">
        <div class="card space-y-6">
          <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-500">Full Name</label>
                <p class="mt-1 text-gray-900">{{ user.first_name }} {{ user.last_name }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500">Email</label>
                <p class="mt-1 text-gray-900">{{ user.email }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card space-y-6">
          <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h2>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-500">Country</label>
                <p class="mt-1 text-gray-900">{{ user.address.country }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500">City</label>
                <p class="mt-1 text-gray-900">{{ user.address.city }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500">Post Code</label>
                <p class="mt-1 text-gray-900">{{ user.address.post_code }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500">Street</label>
                <p class="mt-1 text-gray-900">{{ user.address.street }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Layout from '../../Layouts/Layout.vue'

defineProps({
  user: {
    type: Object,
    required: true
  }
})
</script>
