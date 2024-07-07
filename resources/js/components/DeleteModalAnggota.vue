<template>
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white shadow-lg rounded-md p-4 max-w-sm w-full">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
                <p>Anda yakin ingin menghapus anggota ini?</p>
            </div>
            <div class="flex justify-end">
                <button @click="closeModal()" class="px-4 py-2 text-gray-500 hover:text-red-500 border border-gray-300 hover:border-red-500 rounded-md">Batal</button>
                <button @click="deleteAnggota()" class="px-4 py-2 ml-2 text-white bg-red-500 hover:bg-red-600 rounded-md">Hapus</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        closeModal() {
            this.$emit('close');
        },
        deleteAnggota() {
            // Buat fungsi untuk menghapus anggota, bisa menggunakan Axios atau fetch ke endpoint Laravel
            // Setelah selesai, emit event untuk menutup modal
            this.$emit('delete');
        }
    }
}
</script>

<style scoped>
/* Styles untuk modal */
</style>
