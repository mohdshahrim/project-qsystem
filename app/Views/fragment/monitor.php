<div class="w3-container"
x-data="{
    reload_monitor: false,
    sites: [],
    monitors: [],
    async loadSites({sites}){
        const response = await fetch('/fragment/site/api/get-sites');

        if (!response.ok) {
            console.log('error ${response.status}');
        } else {
            const data = await response.json();
            this.sites = data.sites;
            console.log(data.sites);
        }
    },
    loadMonitors(){
        this.sites.forEach((s,i)=>{
            // checkbox id format for sites = site-{sequence}-{id}
            // console.log(`site-${i+1}-${s.id}`);
            // document.getElementById(`site-${i+1}-${s.id}`).disabled = true;

            if (document.getElementById(`site-${i+1}-${s.id}`).checked==true) {
                
                fetch(`/fragment/monitor/api/get-by-site/${s.id}`)
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

x-init="loadSites({$data})">
    <h1>List of Monitors</h1>

    <span>
        <button x-on:click="loadMonitors()">load</button>
    </span>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/fragment/monitor/new" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <span>
            <template x-for="(item, index) in sites">
                <div class="w3-margin-right" style="display: inline-block;" x-id="['site', item.id]">
                    <input class="w3-check" type="checkbox" :id="$id('site', item.id)" :value="item.id" checked>
                    <label x-text="item.site_id" :for="$id('site', item.id)" :title="item.site_name"></label>
                </div>
            </template>
        </span>

        &nbsp;
        &nbsp;
        &nbsp;

        <div class="w3-margin-left" style="display: inline-block;">
            <input class="w3-check w3-margin-left" type="checkbox" id="include-unhosted">
            <label for="include-unhosted">include unhosted</label>
        </div>
    </div>

    <br>

    <!-- table -->
    <table class="w3-table w3-white w3-border w3-bordered">
        <tr>
            <td>no</td>
            <td>asset no</td>
            <td>serial no</td>
            <td>model</td>
            <td>screen size</td>
            <td>host</td>
            <td>site</td>
            <td>notes</td>
            <td>created at</td>
            <td>updated at</td>
        </tr>

        <template x-for="(item, index) in monitors">
            <tr>
                <td x-text="(index+1)"></td>
                <td x-text="item.asset_no"></td>
                <td x-text="item.serial_no"></td>
                <td x-text="item.model"></td>
                <td x-text="item.screen_size"></td>

                <td x-text="item.host"></td>
                <td x-text="item.site"></td>
                <td x-text="item.notes"></td>
                <td class="w3-small" x-text="item.created_at"></td>
                <td class="w3-small" x-text="item.updated_at"></td>

                <td class="w3-center">
                    <a href="/fragment/monitor/1">view</a>
                    &nbsp;
                    <a href="/fragment/monitor/edit/1">edit</a>
                </td>
            </tr>
        </template>
    </table>
</div>