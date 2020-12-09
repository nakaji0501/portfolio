<template>
<div>

<header>
<Navbar />
</header>

<main>

<div class="container">
<router-view />
</div>

</main>

<footer>

</footer>

</div>
</template>

<script>
import Navbar from './components/Navbar'

export default {
    components: {
        Navbar,
    }

}
</script>