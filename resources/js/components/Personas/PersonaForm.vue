<script setup>
import { useForm } from "@inertiajs/vue3";
import personas from "@/routes/personas";

defineProps({
    mostrar: Boolean,
});

const emit = defineEmits(["cerrar"]);

const form = useForm({
    carnet: "",
    complementario: "",
    nombres: "",
    apellido_paterno: "",
    apellido_materno: "",
    apellido_casado: "",
    celular: "",
    genero: "",
    fecha_nacimiento: "",
    estado_civil: "",
    email: "",
});

function guardar() {
    form.post(personas.store(), {
        onSuccess: () => {
            emit("cerrar");
            form.reset();
            form.clearErrors();
        },
    });
}

function cerrarFormulario() {
    form.reset();
    form.clearErrors();
    emit("cerrar");
}
</script>

<template>
    <!-- Modal -->
    <div
        v-if="mostrar"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
    >
        <!-- Contenedor del formulario -->
        <div class="w-full max-w-2xl rounded-lg bg-white shadow-xl">
            <!-- Encabezado -->
            <div class="flex items-center justify-between border-b px-6 py-4">
                <div>
                    <h2 class="text-lg font-semibold">Nueva persona</h2>

                    <p class="text-sm text-gray-500">
                        Registrar información personal
                    </p>
                </div>

                <button
                    type="button"
                    class="rounded-md p-2 text-gray-500 hover:bg-gray-100"
                    title="Cerrar"
                    @click="cerrarFormulario"
                >
                    ✕
                </button>
            </div>

            <!-- Formulario -->
            <form class="px-6 py-5" @submit.prevent="guardar">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Carnet -->
                    <div>
                        <label
                            for="carnet"
                            class="text-sm font-medium text-gray-700"
                        >
                            Carnet
                        </label>

                        <input
                            id="carnet"
                            type="text"
                            v-model="form.carnet"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.carnet"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.carnet }}
                        </p>
                    </div>

                    <!-- Complementario -->
                    <div>
                        <label
                            for="complementario"
                            class="text-sm font-medium text-gray-700"
                        >
                            Complementario
                        </label>

                        <input
                            id="complementario"
                            type="text"
                            v-model="form.complementario"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.complementario"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.complementario }}
                        </p>
                    </div>

                    <!-- Nombres -->
                    <div class="col-span-2">
                        <label
                            for="nombres"
                            class="text-sm font-medium text-gray-700"
                        >
                            Nombres
                        </label>

                        <input
                            id="nombres"
                            type="text"
                            v-model="form.nombres"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.nombres"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.nombres }}
                        </p>
                    </div>

                    <!-- Apellido paterno -->
                    <div>
                        <label
                            for="apellido_paterno"
                            class="text-sm font-medium text-gray-700"
                        >
                            Apellido paterno
                        </label>

                        <input
                            id="apellido_paterno"
                            type="text"
                            v-model="form.apellido_paterno"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.apellido_paterno"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.apellido_paterno }}
                        </p>
                    </div>

                    <!-- Apellido materno -->
                    <div>
                        <label
                            for="apellido_materno"
                            class="text-sm font-medium text-gray-700"
                        >
                            Apellido materno
                        </label>

                        <input
                            id="apellido_materno"
                            type="text"
                            v-model="form.apellido_materno"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.apellido_materno"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.apellido_materno }}
                        </p>
                    </div>

                    <!-- Apellido de casado -->
                    <div>
                        <label
                            for="apellido_casado"
                            class="text-sm font-medium text-gray-700"
                        >
                            Apellido de casado
                        </label>

                        <input
                            id="apellido_casado"
                            type="text"
                            v-model="form.apellido_casado"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.apellido_casado"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.apellido_casado }}
                        </p>
                    </div>

                    <!-- Celular -->
                    <div>
                        <label
                            for="celular"
                            class="text-sm font-medium text-gray-700"
                        >
                            Celular
                        </label>

                        <input
                            id="celular"
                            type="text"
                            v-model="form.celular"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />

                        <p
                            v-if="form.errors.celular"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.celular }}
                        </p>
                    </div>

                    <!-- Género -->
                    <div>
                        <label
                            for="genero"
                            class="text-sm font-medium text-gray-700"
                        >
                            Género
                        </label>

                        <select
                            id="genero"
                            v-model="form.genero"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        >
                            <option value="">Seleccionar</option>

                            <option value="femenino">Femenino</option>

                            <option value="masculino">Masculino</option>
                        </select>
                        <p
                            v-if="form.errors.genero"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.genero }}
                        </p>
                    </div>

                    <!-- Fecha de nacimiento -->
                    <div>
                        <label
                            for="fecha_nacimiento"
                            class="text-sm font-medium text-gray-700"
                        >
                            Fecha de nacimiento
                        </label>

                        <input
                            id="fecha_nacimiento"
                            type="date"
                            v-model="form.fecha_nacimiento"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.fecha_nacimiento"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.fecha_nacimiento }}
                        </p>
                    </div>

                    <!-- Estado civil -->
                    <div>
                        <label
                            for="estado_civil"
                            class="text-sm font-medium text-gray-700"
                        >
                            Estado civil
                        </label>

                        <input
                            id="estado_civil"
                            type="text"
                            v-model="form.estado_civil"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.estado_civil"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.estado_civil }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="text-sm font-medium text-gray-700"
                        >
                            Correo electrónico
                        </label>

                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            class="mt-1 w-full rounded-md border px-3 py-2 text-sm"
                        />
                        <p
                            v-if="form.errors.email"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.email }}
                        </p>
                    </div>
                </div>

                <!-- Pie -->
                <div class="mt-6 flex justify-end gap-2 border-t pt-4">
                    <button
                        type="button"
                        class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200"
                        @click="cerrarFormulario"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="rounded-md bg-black px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
