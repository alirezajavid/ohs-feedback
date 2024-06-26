<template>
    <div>
        <b-table striped hover :items="items" >
            <template #cell(action)="data">
                <b-button size="sm" @click="updateRecord(data)"  v-b-modal.modalPopover variant="outline-secondary"><b-icon-pencil /></b-button> &nbsp;
                <b-button size="sm" @click="removeRecord(data)" variant="outline-secondary"><b-icon-trash /></b-button> 
          </template>
        </b-table>
        
        
        <b-modal @ok="save" ref="my-modal" id="modalPopover" title="Item Configurations">
            <b-input v-model="current.name" /><br />
            <b-input v-model="current.email" /><br />
        </b-modal>
    </div>
</template>

<script>

export default {
    data () {
        return {
            current: {},
            items: []
        }
    },
    methods: {
        updateRecord(r) {
            this.current = r.item
        },
        removeRecord(r) {
            this.items = this.items.filter(rec => rec.id != r.item.id)
            var i = 0;
            this.items.forEach(rec => rec.id = ++i)
        },
        save () {
            alert('s')
        }
    },
    created () {
        this.$api
            .get("/feedback/api/?action=menu")
            .then(
                r => this.items = r.data.map(r => { return { ...r, action: '' } })
            )
    }    
}
 
</script>
