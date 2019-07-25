<template>
    <div>
    <BrandExtraGameForm :brand_id="brand_id"/>
    </div>
</template>

<script>

    import BrandExtraGameForm from "./BrandExtraGameForm";

    export default {
        name: "BrandExtraGames",

        components: {BrandExtraGameForm},

        props: ['brand_id'],
    }
</script>

<style scoped>

</style>