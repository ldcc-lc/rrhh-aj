<script setup>

    defineProps({
        mostrar: {
            type: Boolean,
            default: false,
        },

        titulo: {
            type: String,
            default: '¿Está seguro?',
        },

        mensaje: {
            type: String,
            default: 'Esta acción no se puede deshacer.',
        },

        textoConfirmar: {
            type: String,
            default: 'Confirmar',
        }
    });


    const emit = defineEmits([
    'cancelar',
    'confirmar',

]);


</script>

<template>

    <!-- Fondo del modal -->
    <div
        v-if="mostrar"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    >
        <!-- Cuadro de confirmación -->
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl">

            <!-- Título -->
            <h2 class="text-lg font-semibold text-gray-900">
                {{ titulo }}
            </h2>

            <!-- Mensaje -->
            <p class="mt-2 text-sm text-gray-600">
                {{ mensaje }}
            </p>

            <!-- Botones -->
            <div class="mt-6 flex justify-end gap-3">

                <!-- Cancelar -->
                <button
                    type="button"
                    class="rounded-md border px-4 py-2 text-sm hover:bg-gray-100"
                    @click="emit('cancelar')"
                >
                    Cancelar
                </button>

                <!-- Confirmar -->
                <button
                    type="button"
                    class="rounded-md bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-700"
                    @click="emit('confirmar')"
                >
                    {{textoConfirmar}}
                </button>

            </div>
        </div>
    </div>
</template>
