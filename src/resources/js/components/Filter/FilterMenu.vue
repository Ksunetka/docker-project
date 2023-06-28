<template>
    <v-menu :close-on-content-click="false" offset-x bottom>
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="indigo" icon v-bind="attrs" v-on="on" :disabled="!items.length">
                <v-icon small :color="activeColor">
                    mdi-filter-variant
                </v-icon>
            </v-btn>
        </template>
        <v-card class="mx-auto">
            <v-card-text class="pb-0 pt-1 px-1">
                <v-text-field
                    prepend-inner-icon="mdi-magnify"
                    ref="search"
                    v-model="search"
                    hide-details
                    :label="$t('table.search')"
                    single-line
                />
            </v-card-text>
            <v-list flat dense class="pa-0">
                <v-list-item-group multiple v-model="activeItems" class="py-2">
                    <template v-for="(item, index) in filteredItems">
                        <v-list-item
                            :key="`${item}-${index}`"
                            :value="item"
                        >
                            <template v-slot:default="{ active }">
                                <v-list-item-action>
                                    <v-checkbox
                                        :input-value="active"
                                        color="primary"
                                    />
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title v-text="item"/>
                                </v-list-item-content>
                            </template>
                        </v-list-item>
                    </template>
                </v-list-item-group>
            </v-list>
        </v-card>
    </v-menu>
</template>

<script>
export default {
    name: "FilterMenu",
    props: {
        value: {
            type: Array,
            default: [],
        },
        items: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            search: '',
        };
    },
    computed: {
        activeItems: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit('input', value);
            },
        },
        activeColor() {
            return this.activeItems.length ? 'accent' : 'secondary';
        },
        filteredItems() {
            const search = this.search.toLowerCase();

            if (!search) return this.items;

            return this.items.filter(item => {
                const value = item.toLowerCase();

                return value.indexOf(search) > -1;
            })
        },
    },
}
</script>

<style scoped>

</style>
