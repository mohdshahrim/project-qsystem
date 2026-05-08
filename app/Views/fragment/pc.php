<div class="w3-container"
x-data="{
    sites: [],
    pcs: [],
    resetPCs(){
        this.pcs = [];
    },
    loadSites() {
        fetch('/fragment/site/api/get-sites')
            .then(response => {
                if (!response.ok) {
                    console.log('error during fetch for loadSites()');
                }
                return response.json();
            })
            .then(data => {
                this.sites = data.sites;
                console.log(data.sites);
            })
            .then(()=>{
                this.loadPCs();
            });
    },
    loadPCs() {
        this.sites.forEach((s,i)=>{
            if (document.getElementById(`site-${i+1}-${s.id}`).checked==true) {
                
                fetch(`/fragment/pc/api/get-by-site/${s.id}`)
                    .then(response => {
                        if (!response.ok) {
                            console.log('not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        this.pcs.push(...data.pc);
                    });
            }
        });
    }
}"

x-init="loadSites()">
    <h1>List of PC</h1>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/fragment/pc/new" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <span>
            <template x-for="(item, index) in sites">
                <div class="w3-margin-right" style="display: inline-block;" x-id="['site', item.id]">
                    <input class="w3-check" type="checkbox" :id="$id('site', item.id)" :value="item.id" x-on:change="resetPCs();loadPCs()" checked>
                    <label x-text="item.site_id" :for="$id('site', item.id)" :title="item.site_name"></label>
                </div>
            </template>
        </span>
    </div>

    <br>

    <!-- table -->
    <table class="w3-table w3-white w3-border w3-bordered w3-hoverable">
        <tr>
            <td class="w3-border-right">no</td>
            <td class="w3-border-right">hostname</td>
            <td class="w3-border-right">asset no</td>
            <td class="w3-border-right">serial no</td>
            <td class="w3-border-right">model</td>
            <td class="w3-border-right">os</td>
            <td class="w3-border-right">ip address</td>
            <td class="w3-border-right">assigned user</td>
            <td class="w3-border-right">site</td>
            <td>options</td>
        </tr>

        <template x-for="(item, index) in pcs">
            <tr class="w3-small">
                <td x-text="(index+1)" class="w3-border-right"></td>
                <td x-text="item.hostname" class="w3-border-right"></td>
                <td x-text="item.asset_no" class="w3-border-right"></td>
                <td x-text="item.serial_no" class="w3-border-right"></td>
                <td x-text="item.model" class="w3-border-right"></td>

                <td x-text="item.os" class="w3-border-right"></td>
                <td x-text="item.ip_address" class="w3-border-right"></td>
                <td x-text="item.fullname" class="w3-border-right"></td>
                <td x-text="item.site_id" class="w3-border-right"></td>
                <td class="w3-center">
                    <a :href="'/fragment/pc/' + item.id">view</a>
                    &nbsp;
                    <a :href="'/fragment/pc/edit/' + item.id">edit</a>
                </td>
            </tr>
        </template>
    </table>
</div>