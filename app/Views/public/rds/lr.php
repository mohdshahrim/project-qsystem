<div x-data="{
    month: 1,
    year: 2025,
    yearmonth: '2025-01',
    url: ` `,
    lr: [],
    fetchLR() {
        // deconstruct the yearmonth
        this.year = this.yearmonth.substring(0,4);
        this.month = parseInt(this.yearmonth.substring(5));

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
    updateURL() {
        this.year = this.yearmonth.substring(0,4);
        this.month = parseInt(this.yearmonth.substring(5));
        this.url = `/rds/print/3?year=${this.year}&month=${this.month}`;
    },
    reformatDate(d) {
        const newDate = new Date(d);
        return newDate.toLocaleDateString('en-my', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        });
    },
    init() {
        this.updateURL();
    }
}" x-init="fetchLR">
    <div class="hidden-print">
        <p>
            <a href="/">home</a>
            >
            <a href="/public/rds">rds</a>        
            >
            <a href="/public/rds/lr">lr</a>
        </p>
    </div>

    <div>
        <h1>Licensee Report (LR)</h1>
    </div>

    <div class="w3-grid w3-grid-padding" style="grid-template-columns: 250px 200px; align-items: center;">
        <div>
            <input class="w3-input w3-border" type="month" x-model="yearmonth" x-on:change="updateURL()">
        </div>
        <div class="hidden-print">
            <button class="w3-button w3-red w3-round-large" x-on:click="fetchLR">Search</button>
            &nbsp;
            <a target="_blank" class="w3-button w3-blue w3-round-large" x-bind:href="url">
                <i class="fa fa-print"></i>
                Print
            </a>
        </div>
    </div>

    <br>

    <div>
        <table id="table-report" class="w3-table w3-border w3-bordered">
            <tr>
                <th>No.</th>
                <th>License No</th>
                <th>Licensee</th>
                <th>Contact person</th>
                <th>Delivery date</th>
                <th>Status</th>
            </tr>
            <tbody>
                <template x-if="Object.keys(lr).length === 0">
                    <tr>
                        <td colspan="5" style="text-align:center;">no data</td>
                    </tr>
                </template>
                <template x-for="(item, index) in lr" :key="item.id">
                    <tr>
                        <td x-text="index+1"></td>
                        <td x-text="item.license_no"></td>
                        <td x-text="item.licensee_name"></td>
                        <td x-text="item.contact_person"></td>
                        <td x-text="reformatDate(item.delivery_date)"></td>
                        <td x-text="item.status"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>