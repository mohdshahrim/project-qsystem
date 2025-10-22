<div x-data="{
    month: 1,
    year: 2025,
    yearmonth: '2025-01',
    mr: [],
    fetchMR() {
        // deconstruct the yearmonth
        this.year = this.yearmonth.substring(0,4);
        this.month = parseInt(this.yearmonth.substring(5));

        minAjax({
            url: '/rds/api/mr/get',
            type: 'GET',
            data: {
                month: this.month,
                year: this.year,
            },
            success: (response) => {
                data = JSON.parse(response);
                this.mr = data.mr;
            }
        });
    },
}" x-init="fetchMR">
    <div>
        <p>
            <a href="/">home</a>
            >
            <a href="/public/rds">rds</a>        
            >
            <a href="/public/rds/mr">mr</a>
        </p>
    </div>

    <div>
        <h1>Mill Report (MR)</h1>
    </div>

    <div class="w3-grid w3-grid-padding" style="grid-template-columns: 250px 200px; align-items: center;">
        <div>
            <input class="w3-input w3-border" type="month" x-model="yearmonth">
        </div>
        <div>
            <button class="w3-button w3-red w3-round-large" x-on:click="fetchMR">Search</button>
        </div>
    </div>

    <br>

    <div>
        <table id="table-report" class="w3-table w3-border w3-bordered">
            <tr>
                <th>No.</th>
                <th>Mill No</th>
                <th>Processor Name</th>
                <th>Email</th>
                <th>Contact person</th>
                <th>Delivery date</th>
                <th>Status</th>
            </tr>
            <tbody>
                <template x-if="Object.keys(mr).length === 0">
                    <tr>
                        <td colspan="6" style="text-align:center;">no data</td>
                    </tr>
                </template>
                <template x-for="(item, index) in mr" :key="item.id">
                    <tr>
                        <td x-text="index+1"></td>
                        <td x-text="item.mill_no"></td>
                        <td x-text="item.mill_name"></td>
                        <td x-text="item.email"></td>
                        <td x-text="item.contact_person"></td>
                        <td x-text="item.delivery_date"></td>
                        <td x-text="item.status"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>