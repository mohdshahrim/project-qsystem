<?php
    $session = session();
    if ($session->getFlashData('message')) {
        $message = $session->getFlashData('message');
        echo "<div style=\"width:auto; height:auto; position:absolute; top:2em; place-self:center;\" class=\"w3-yellow w3-padding w3-round\">";
        echo $message;
        echo "</div>";
    }
?>

<div class="w3-container"
x-data="{
    sortBy: 'model-asc', // default
    get testSort() {

        ascending = true;
        colName = 'model';

        switch(this.sortBy) {
            case 'model-asc':
                colName = 'model';
                ascending = true;
                break;
            case 'model-des':
                colName = 'model';
                ascending = false;
                break;
            default:
                colName = 'model';
                ascending = true;
                break;
        }

        return [...this.printers].sort((a,b) => {
            const valA = a[colName];
            const valB = b[colName];

            if (typeof valA === 'string') {
                return ascending
                ? valA.localeCompare(valB)
                : valB.localeCompare(valA);
            }

            return ascending ? valA - valB : valB - valA;
        });  
    },
    newprinter: <?php echo $session->getFlashData('newprinter')? $session->getFlashData('newprinter'):'false';?>,
    sites: [],
    printers: [],
    resetPrinters(){
        this.printers = [];
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
                this.loadPrinters();
            });
    },
    loadPrinters() {
        this.sites.forEach((s,i)=>{
            if (document.getElementById(`site-${i+1}-${s.id}`).checked==true) {
                
                fetch(`/fragment/printer/api/get-by-site/${s.id}`)
                    .then(response => {
                        if (!response.ok) {
                            console.log('not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        this.printers.push(...data.printer);
                    });
            }
        });
    }
}"

x-init="loadSites()">
    <h1>List of Printers</h1>

    <div>
        <div class="w3-margin-right" style="display: inline-block;">
            <a href="/fragment/printer/new" class="w3-button w3-asphalt w3-round">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <span>
            <template x-for="(item, index) in sites">
                <div class="w3-margin-right" style="display: inline-block;" x-id="['site', item.id]">
                    <input class="w3-check" type="checkbox" :id="$id('site', item.id)" :value="item.id" x-on:change="resetPrinters();loadPrinters()" checked>
                    <label x-text="item.site_id" :for="$id('site', item.id)" :title="item.site_name"></label>
                </div>
            </template>
        </span>
        <span>
            <select x-ref="selsortby" x-on:change="sortBy=$refs.selsortby.value;resetPrinters();loadPrinters()">
                <option value="model-asc">model (ascending)</option>
                <option value="model-des">model (descending)</option>
            </select>
        </span>
    </div>

    <br>

    <!-- table -->
    <table class="w3-table w3-white w3-border w3-bordered w3-hoverable">
        <tr>
            <td class="w3-border-right">no</td>
            <td class="w3-border-right">serial no</td>
            <td class="w3-border-right">model</td>
            <td class="w3-border-right">nickname</td>
            <td class="w3-border-right">printer type</td>

            <td class="w3-border-right">site</td>
            <td class="w3-border-right">host</td>
            <td class="w3-border-right">IP address</td>
            <td class="w3-border-right">is rental?</td>

            <td>options</td>
        </tr>

        <template x-for="(item, index) in testSort">
            <tr :class="(newprinter && item.id==newprinter)? 'w3-small w3-yellow':'w3-small'">
                <td x-text="(index+1)" class="w3-border-right"></td>
                <td x-text="item.serial_no" class="w3-border-right"></td>
                <td x-text="item.model" class="w3-border-right"></td>
                <td x-text="item.nickname" class="w3-border-right"></td>
                <td x-text="item.printer_type" class="w3-border-right"></td>

                <td x-text="item.site_id" class="w3-border-right"></td>
                <td x-text="item.host" class="w3-border-right"></td>
                <td x-text="item.ip_address" class="w3-border-right"></td>
                <td x-text="Boolean(item.is_rental)==Boolean(1)?'yes':'no'" class="w3-border-right"></td>

                <td class="w3-center">
                    <a :href="'/fragment/printer/' + item.id">view</a>
                    &nbsp;
                    <a :href="'/fragment/printer/delete/' + item.id">delete</a>
                </td>
            </tr>
        </template>
    </table>
</div>