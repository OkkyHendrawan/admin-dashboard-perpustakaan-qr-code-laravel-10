<template>
    <div id="previewModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white shadow-lg rounded-md p-4 max-w-sm w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">{{ anggota.anggota_nama }}</h3>
                <button @click="closeModal()" class="text-gray-500 hover:text-red-500 focus:outline-none">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <div>
                <p><strong>Kode Anggota:</strong> {{ anggota.anggota_kode }}</p>
                <p><strong>Alamat:</strong> {{ anggota.anggota_alamat }}</p>
                <p><strong>Jenis:</strong> {{ anggota.anggota_jenis }}</p>
                <p><strong>Tanggal Daftar:</strong> {{ anggota.anggota_tgl_daftar }}</p>
                <!-- Tambahkan info lainnya sesuai kebutuhan -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        anggota: Object
    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    }
}
</script>

<style scoped>
/* Styles untuk modal */
</style>
