<template>
    <div>
        <ul>
            <li v-for="item in cartItems">
                <div>
                    <span class="title">Brand:</span><span>{{ item.brand_id }}</span>
                </div>
                <div>
                    <span class="title" v-if="item.extra_games">Extra games</span>
                    <span class="title" v-if="item.extra_games">
                        <ul>
                            <li v-for="e_game in item.extra_games">
                                {{ e_game.system_name }}
                            </li>
                        </ul>
                    </span>
                </div>
                <div v-if="item.brand_id == 'de_lotto'">
                    <span class="title">Ticket number</span>
                    <ul>
                        <li v-for="tn in item.ticketNumber">{{ tn }}</li>
                    </ul>
                </div>
                <div>
                    <span class="title">Tickets:</span>
                    <span>
                        <ul>
                            <li v-for="ticket in item.tickets">
                                <span class="title">Number:</span> <span>{{ ticket.number }}</span>
                                <span class="title">Line: </span> <span>{{ ticket.line.join(',') }}</span>
                                <span class="title" v-if="ticket.special_pool">Special pool: </span> <span v-if="ticket.special_pool">{{ ticket.special_pool.join(',') }}</span>
                                <span class="title">Number shield</span><span> {{ ticket.is_protected == 1 ? 'Yes' : 'No' }} </span>
                            </li>
                        </ul>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "UserBetPendingCartItems",
        props: ['items'],

        data() {
            return {
                cartItems: []
            }
        },

        created() {
            this.cartItems = this.$props.items;
        }
    }
</script>

<style scoped>
    .title {
        font-weight: bold;
    }
</style>
