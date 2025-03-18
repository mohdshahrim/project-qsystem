
<script src="/js/mustache.min.js" defer></script>
<!--<script src="/js/dayjs.min.js" defer></script>-->
<script defer>
// RULES
// 1. no semicolon
// 2. camelCase for variable and function name
// 3. Same Line Style for opening curly brace

var defaultData = {
    "userDetail": {
        "name": "test",
        "designation": "Supervisor",
        "department": "Endorsement",
		"purpose": "for Endorsement activity",
        "date": "2024-03-18",
		"typeEntertainment": false,
		"typeTravelling": true,
		"typeMiscellaneous": false,
    },
    "claimDetail": [
		{
			"WONo": "one",
			"requireWO": true,
			"departureDate": "2024-03-01",
			"departureTime": "0800",
			"returnDate": "2024-03-15",
			"returnTime": "1700",
			"items" : [
				{"type": "lodging", "quantity": 13, "rate": 3000, "value": 39000},
				{"type": "subsistence", "quantity": 14.5, "rate": 5000, "value": 72500},
				{"type": "ticket", "mode": "Express", "ticketno": "Q123", "origin": "Sibu", "destination": "Kapit", "or": false, "value": 3500},
				{"type": "reload", "telco": "Celcom", "serialno": "111606020011440063", "telno": "0198390727", "monthyear": "2024-03", "value": 1000}
			]
		},
		{
			"WONo": "two",
			"requireWO": true,
			"departureDate": "2024-03-01",
			"departureTime": "0800",
			"returnDate": "2024-03-15",
			"returnTime": "1700",
			"items" : [
				{"type": "lodging", "quantity": 13, "rate": 3000, "value": 39000},
			]
		},
	],
	"grandTotal": 0,
}

// init
function init() {
    // sort claim items
    //populate user form
    writeUserForm()
    // populate defaultData into "table-items"
    writeTableItems()
}

function writeUserForm() {
    document.getElementById("input-name").value = defaultData.userDetail.name
    document.getElementById("input-designation").value = defaultData.userDetail.designation
    document.getElementById("input-department").value = defaultData.userDetail.department
    document.getElementById("input-purpose").value = defaultData.userDetail.purpose
    document.getElementById("input-date").value = defaultData.userDetail.date
    document.getElementById("checkbox-entertainment").checked = defaultData.userDetail.typeEntertainment
    document.getElementById("checkbox-travelling").checked = defaultData.userDetail.typeTravelling
    document.getElementById("checkbox-miscellaneous").checked = defaultData.userDetail.typeMiscellaneous
}

// populate defaultData into "table-items"
function writeTableItems() {
    const tableid = "table-items"

    const upperPart = `
    <tr>
        <td class="itemtable-td">WO</td>
        <td class="itemtable-td">Description</td>
        <td class="itemtable-td">#</td>
        <td class="itemtable-td">Value</td>
        <td class="itemtable-td">Option</td>
    </tr>
    `

    const lowerPart = `
    <tr>
        <td class="itemtable-tdlast" colspan="3" style="text-align:right;">Grand total (RM)</td>
        <td class="itemtable-tdlast" colspan="2"></td>
    </tr>
    `

    var middlePart = ``
    var tempString = ``
    var tempSet = `` // per WO, to contain item set
    var tempItem = `` // to contain item

    const totalWO = defaultData.claimDetail.length
    //const totalWO=2 //TEST: to simulate 0 WO

    if (totalWO==0) {
        middlePart = `<tr><td class="itemtable-td" colspan="5">please add WO first</td></tr>`
    } else {
        for (var i=0; i<totalWO; i++) {
            var totalItem = defaultData.claimDetail[i].items.length
            //const totalItem = 0 //to simulate n items

            if (totalItem==0) {
                // if the WO has no item
                tempSet += `
                <tr>
                    <td class="itemtable-td">` + defaultData.claimDetail[i].WONo + `</td>
                    <td class="itemtable-td" colspan="4" style="text-align:center;"> please add item </td>
                </tr>`
            } else {
                // if the WO has at least 1 item
                // WO part
                tempSet += `<tr><td rowspan="` + totalItem + `" class="itemtable-td">` + defaultData.claimDetail[i].WONo + `</td>`

                // first item part
                tempSet += `<td class="itemtable-td">` + writeDescription(i,0) + `</td>`
                tempSet += `<td class="itemtable-td">` + writeQuantity(i,0) + `</td>`
                tempSet += `<td class="itemtable-td itemtable-td-value">` + writeValue(i,0) + `</td>`
                tempSet += `<td class="itemtable-td">` + writeOption(i,0) + `</td>`
                tempSet += `</tr>`
                // close the above first item altogether with its WO part

                // index begin after 0 because the first item already covered
                for (j=1; j<totalItem; j++) {
                    tempItem += `<tr>`
                    tempItem += `<td class="itemtable-td">` + writeDescription(i,j) + `</td>`
                    tempItem += `<td class="itemtable-td">` + writeQuantity(i,j) + `</td>`
                    tempItem += `<td class="itemtable-td itemtable-td-value">` + writeValue(i,j) + `</td>`
                    tempItem += `<td class="itemtable-td">` + writeOption(i,j) + `</td>`
                    tempItem += `</tr>`
                }

                tempSet += tempItem
                tempItem = `` //reset
            }

            // flush into middlePart
            middlePart += tempSet
            tempSet = `` // reset
        }
    }

    document.getElementById(tableid).innerHTML = upperPart + middlePart + lowerPart
}

// generate claim item description
function writeDescription(WOIndex, itemIndex) {
    const itemType = defaultData.claimDetail[WOIndex].items[itemIndex].type
    var description = ""

    switch(itemType) {
        case "subsistence":
            description = writeSubsistence(WOIndex, itemIndex)
            break
        case "lodging":
            description = writeLodging(WOIndex, itemIndex)
            break
        case "ticket":
            description = writeTicket(WOIndex, itemIndex)
            break
        case "reload":
            description = writeReload(WOIndex, itemIndex)
            break
        case "other":
            description = defaultData.claimDetail[WOIndex].items[itemIndex].desc
            break
        default:
            description = "NO DESCRIPTION FOR THIS TYPE (" + itemType + ")"
            break
    }

    return description
}

// generate quantity figure if any
function writeQuantity(WOIndex, itemIndex) {
    const itemType = defaultData.claimDetail[WOIndex].items[itemIndex].type
    var quantity = ""

    switch(itemType) {
        case "subsistence":
            quantity = defaultData.claimDetail[WOIndex].items[itemIndex].quantity + " days"
            break
        case "lodging":
            quantity = defaultData.claimDetail[WOIndex].items[itemIndex].quantity + " nights"
            break
        case "ticket":
            quantity = "-"
            break
        case "reload":
            quantity = "-"
            break
        case "other":
            quantity = "-"
            break
        default:
            quantity = "NO DESCRIPTION FOR THIS TYPE (" + itemType + ")"
            break
    }

    return quantity
}

// generate value figure if any
function writeValue(WOIndex, itemIndex) {
    const item = defaultData.claimDetail[WOIndex].items[itemIndex]
    var val = ""

    val = toRM(item.value)

    return val
}

// generate option if any
function writeOption(WOIndex, itemIndex) {
    return "option"
}

// generate subsistence description
function writeSubsistence(WOIndex, itemIndex) {
    var description = ""
    description = "Subsistence Allowance @ RM" + toRM(defaultData.claimDetail[WOIndex].items[itemIndex].rate) + " per day"
    return description
}

// generate lodging description
function writeLodging(WOIndex, itemIndex) {
    var description = ""
    description = "Lodging Allowance @ RM" + toRM(defaultData.claimDetail[WOIndex].items[itemIndex].rate) + " per night"
    return description
}

// generate ticket description
function writeTicket(WOIndex, itemIndex) {
    const item = defaultData.claimDetail[WOIndex].items[itemIndex]
    var description = ""

    switch(item.or) {
        case true:
            description = item.mode + " fare " + item.origin + " to " + item.destination + ", Official Receipt No. " + item.ticketno
            break
        case false:
            description = item.mode + " fare " + item.origin + " to " + item.destination + ", Ticket No. " + item.ticketno
            break
    }
    
    return description
}

// generate reload description
function writeReload(WOIndex, itemIndex) {
    const item = defaultData.claimDetail[WOIndex].items[itemIndex]
    var description = ""

    description = "Being claim for " + item.telno + " reload coupon for " + item.monthyear + ", Receipt no. " + item.serialno + " " + item.telno

    return description
}

// generate other description
function writeOther(WOIndex, itemIndex) {
    return ""
}

// function to convert cents to RM (eg: 1030 -> RM10.00)
function toRM(value) {
    return (value/100).toFixed(2)
}

// function to convert RM to cents (eg: RM10.30 => 1030)
function toCent(value) {
	return parseInt(value*100)
}

// below is functions dedicated to handle open dialog
// purpose: CREATE (for new), READ (for updating)

// WO dialog
function dialogWO(purpose,woIndex,itemIndex) {
    const id = "dwo"
    switch(purpose) {
        case "CREATE":
            document.getElementById(id).show()
            break
        case "READ":
            break
    }
}


// TEST
console.log("tehee")

// init
init()
</script>