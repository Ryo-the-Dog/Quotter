<template>
    <div>
        <header>
            <Navbar />
        </header>

        <main>
            <div class="container">
                <!-- <RouterView /> の部分に、URL に対応する HTML 部品が入れ替わって描画されます。 -->
                <RouterView />
            </div>
        </main>

        <Footer />

    </div>
</template>

<script>
    import Navbar from './components/Navbar.vue'
    import Footer from './components/Footer.vue'

    export default {
        components: {
            Navbar,
            Footer
        }
    }
</script>
