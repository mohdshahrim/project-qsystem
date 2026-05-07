<div class="w3-container"
x-data="{
    reload_monitor: false,
    sites: [],
    monitors: [],
    resetMonitors(){
        this.monitors = [];
    },
    loadSites(){
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
                this.loadMonitors();
            });
    },
    loadMonitors(){
        this.sites.forEach((s,i)=>{
            // checkbox id format for sites = site-{sequence}-{id}
            // console.log(`site-${i+1}-${s.id}`);
            // document.getElementById(`site-${i+1}-${s.id}`).disabled = true;

            if (document.getElementById(`site-${i+1}-${s.id}`).checked==true) {
                
                fetch(`/fragment/monitor/api/get-by-site/${s.id}?only_unhosted=false`)
                    .then(response => {
                        if (!response.ok) {
                            console.log('not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        this.monitors.push(...data.monitor);
                        console.log(this.monitors);
                    });
            }
        });
    }
}"

x-init="loadSites()">
    <h1>List of Monitors</h1>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/fragment/monitor/new" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <span>
            <template x-for="(item, index) in sites">
                <div class="w3-margin-right" style="display: inline-block;" x-id="['site', item.id]">
                    <input class="w3-check" type="checkbox" :id="$id('site', item.id)" :value="item.id" x-on:change="resetMonitors();loadMonitors()" checked>
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
            <td class="w3-border-right">asset no</td>
            <td class="w3-border-right">serial no</td>
            <td class="w3-border-right">model</td>
            <td class="w3-border-right">screen size</td>
            <td class="w3-border-right">host</td>
            <td class="w3-border-right">site</td>
            <td class="w3-border-right">notes</td>
            <td class="w3-border-right">created at</td>
            <td class="w3-border-right">updated at</td>
            <td>options</td>
        </tr>

        <template x-for="(item, index) in monitors">
            <tr class="w3-small">
                <td x-text="(index+1)" class="w3-border-right"></td>
                <td x-text="item.asset_no" class="w3-border-right"></td>
                <td x-text="item.serial_no" class="w3-border-right"></td>
                <td x-text="item.model" class="w3-border-right"></td>
                <td x-text="item.screen_size" class="w3-border-right"></td>

                <td x-text="item.hostname" class="w3-border-right"></td>
                <td x-text="item.site_id" class="w3-border-right"></td>
                <td x-text="item.notes" class="w3-border-right"></td>
                <td class="w3-tiny w3-border-right" x-text="item.created_at"></td>
                <td class="w3-tiny w3-border-right" x-text="item.updated_at"></td>

                <td class="w3-center">
                    <a :href="'/fragment/monitor/' + item.id">view</a>
                    &nbsp;
                    <a :href="'/fragment/monitor/edit/' + item.id">edit</a>
                </td>
            </tr>
        </template>
    </table>
</div>