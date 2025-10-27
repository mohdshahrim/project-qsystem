<script src="/js/bootstrap.min.js" defer></script>
<script src="/js/minAjax.js" defer></script>
<script src="/js/alpinejs.min.js" defer></script>

<style>
/* table */
.table-crud {
    border-collapse: collapse;
    border: 1px solid black;
    table-layout: fixed;
}
.table-crud tr th,td {
    padding: 0.2em;
    border: 1px solid black;
}
.table-crud tr:hover {
    background-color: lightgray;
}
</style>

<main x-data="{
    month: 1,
    year: 2025,
    lr: [],
    lrlicenseeid: '',
    fetchLR({lr}) {
        minAjax({
            url: '/rds/api/lr/get',
            type: 'GET',
            data: {
                month: this.month,
                year: this.year,
            },
            success: (response) => {
                data = JSON.parse(response);
                this.lr = data.lr;
            }
        });
    },
    setDefaultMonth() {
        var padMonth = '01' // default
        if (this.month < 9) {
            padMonth = String('0' + this.month);
        } else {
            padMonth = String(this.month);
        }
        const defMonth = String(this.year + '-' + padMonth);
        document.getElementById('input-month').value = defMonth;
    },
    setDefaultDate() {
        const today = new Date();
        var padMonth = '01' // default
        var padDay = '01' // default

        // padding of month
        if (today.getMonth() < 9) {
            padMonth = String('0' + (today.getMonth()+1));
        } else {
            padMonth = String(today.getMonth()+1);
        }

        // padding of day
        if (today.getDate() < 9) {
            padDay = String('0' + (today.getDate()));
        } else {
            padDay = String(today.getDate());
        }

        document.getElementById('input-date').value = String(today.getFullYear() + '-' + padMonth + '-' + padDay);        
    },
    addNewLR() {
        minAjax({
            url: '/rds/lr/create',
            type: 'POST',
            data: {
                lrlicensee: document.getElementById('input-licensee').value,
                lrmonthyear: document.getElementById('input-month').value,
                lrdeliverydate: document.getElementById('input-date').value,
                lrstatus: document.getElementById('input-status').value,
            },
            success: (response) => {
                // update the month and year
                searchInputMonth = document.getElementById('search-input-month');
                searchInputMonth.value = document.getElementById('input-month').value;
                this.updateMonthYear(searchInputMonth.value);
                this.fetchLR($data);
            }
        })
    },
    getMonthYear({month, year}) {
        if (month<10) {
            // pad the month
            pMonth = String('0' + month);
        }
        s = `${year}-${pMonth}`;
        return s;
    },
    updateMonthYear(val) {
        arr = val.split('-');
        this.year = arr[0];
        this.month = arr[1];
    },
    deleteLR(lr) {
        minAjax({
            url: '/rds/lr/delete',
            type: 'POST',
            data: {
                lr: lr,
            },
            success: (response) => {
                // update the month and year
                searchInputMonth = document.getElementById('search-input-month');
                this.updateMonthYear(searchInputMonth.value);
                this.fetchLR($data);
            }
        })
    },
}" x-init="fetchLR($data); setDefaultMonth(); setDefaultDate();">
    <h3>Licensee Report (LR)</h3>

    <!-- ADDING NEW ITEM -->
    <div>
        <p>
            <span>
                add new
            </span>
            &nbsp;
            <span>
                <select id="input-licensee">
                    <?php foreach ($licensees as $key=>$row):?>
                        <option value="<?= $row['id'] ?>"><?= $row['license_no'].' '.$row['licensee_name']; ?></option>
                    <?php endforeach ?>
                </select>
            </span>
            &nbsp;
            <span>
                <input type="month" id="input-month" />
            </span>
            &nbsp;
            <span>
                <input type="date" id="input-date" />
            </span>
            &nbsp;
            <span>
                <input type="text" id="input-status" value="OK" autocomplete="off"/>
            </span>
            &nbsp;
            <span>
                <button x-on:click="addNewLR()">OK</button>
            </span>    
        </p>
    </div>

    <br>

    <!-- FILTER ITEM -->
    <div>
        <p>
            <span>
                filter
            </span>
            &nbsp;
            <span>
                <input x-init="$el.value=getMonthYear($data)" x-on:change="updateMonthYear($el.value)" type="month" id="search-input-month" />
            </span>
            &nbsp;
            <span>
                <button x-on:click="fetchLR($data)">Search</button>
            </span>
        </p>
    </div>

    <!-- CRUD TABLE -->
    <div>
        <table class="table-crud">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>license no</th>
                    <th>licensee name</th>
                    <th>email</th>
                    <th>delivery date</th>
                    <th>status</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <template x-if="Object.keys(lr).length === 0">
                    <tr>
                        <td colspan="7" style="text-align:center;">no data</td>
                    </tr>
                </template>
                <template x-for="(item, index) in lr" :key="item.id">
                    <tr>
                        <td x-text="index+1"></td>
                        <td x-text="item.license_no"></td>
                        <td x-text="item.licensee_name"></td>
                        <td x-text="item.email"></td>
                        <td x-text="item.delivery_date"></td>
                        <td x-text="item.status"></td>
                        <td>
                            <button x-on:click="deleteLR(item.id)">delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</main>
