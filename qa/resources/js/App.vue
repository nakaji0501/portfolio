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
<Footer />
</footer>

</div>
</template>

<script>
import reset from '../css/reset.css'
import common from '../css/common.css'

import Navbar from './components/Navbar'
import Footer from './components/Footer'

export default {
    components: {
        Navbar,
        Footer,
    }

}
</script>