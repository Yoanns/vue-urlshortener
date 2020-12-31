<template>
    <div class="row justify-content-md-center my-5">
        <div class="col-md-auto clearfix">

            <div class="my-8 py-3 bg-white dark:bg-gray-800 overflow-hidden shape sm:rounded-lg">
                <img class="rounded mx-auto d-block" src="img/link_shortener.svg" width="40%" alt="link_shortener.svg" />
                <div class="row my-2 p-3"></div>
                    <h1 class="text-center blue-text">URL Shortener</h1>

                    <div class="container">
                        <router-view></router-view>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {}
</script>
