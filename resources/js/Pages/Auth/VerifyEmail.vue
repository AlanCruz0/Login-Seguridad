<script setup>
import { ref, computed, onMounted } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    status: String,
    recaptchaSiteKey: String,
});

const form = useForm({
    code: "",
    recaptcha_token: "",
});

const errorMessage = ref("");

const submit = () => {
    if (form.code.length !== 6 || isNaN(form.code)) {
        errorMessage.value = "El código debe tener 6 dígitos.";
        return;
    }
    errorMessage.value = "";

    form.recaptcha_token = window.grecaptcha.getResponse();
    if (!form.recaptcha_token) {
        alert("Por favor, completa el reCAPTCHA.");
        return;
    }

    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const verificationSuccess = computed(() => props.status === "verification-success");

onMounted(() => {
    const script = document.createElement("script");
    script.src = `https://www.google.com/recaptcha/api.js`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
});
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600">
            ¡Gracias por registrarte! Antes de comenzar, puede verificar su
            dirección de correo electrónico donde recibira un codigo de 6 digitos.
        </div>

        
        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationSuccess">
            Código verificado con éxito.
        </div>

        <div class="mb-4 text-sm text-red-600" v-if="errorMessage">
            {{ errorMessage }}
        </div>  

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="code" value="Codigo" />

                <TextInput
                    id="code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code"
                    required
                    autofocus
                    maxlength="6"
                />
                <InputError class="mt-2" :message="form.errors.code" />
            </div>

            <div class="mt-4">
                <div
                    class="g-recaptcha"
                    :data-sitekey="recaptchaSiteKey"
                ></div>
                <InputError class="mt-2" :message="form.errors.recaptcha_token" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Verificar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
