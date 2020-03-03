<template>

<!--    <input type="text">-->
    <p>{{strCount}}/80</p>
</template>

<script>
export  default {
    data() {

        return {
            strLength: "",
        }
    },
    computed: {
        strCount: function() {
            return this.strLength.length;
        }
    }
}
</script>
