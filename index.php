<?php
session_start();

    include("connectdb.php");
    include("functions.php");

    $user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">
    <head>    
        <style>
            body {
                background-image: url("./images/abc.jpg");
                background-position: center;
                /* Center the image */
                background-repeat: no-repeat;
                /* Do not repeat the image */
                background-size:auto;
                /* Resize the background image to cover the entire container */
            }
        </style>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />        
        <title>Expense Tracker App</title>

        <link href="css/style.css" type="text/css" rel="stylesheet" />
    </head>
<body>


    <h2 id="nametg">Hello, <?php echo $user_data['user_name']; ?></h2>
    
    <div class="container">
        <h2>Expense Tracker</h2>
        <h4>Your Balance</h4>
        <h1 id="balance">RS0.00</h1>
        <div class="inc-exp-container">
            <div>
                <h4>Income</h4>
                <p id="money-plus" class="money-plus">
                    +RS0.00
                </p>
            </div>
            <div>
                <h4>Expense</h4>
                <p id="money-minus" class="money-minus">
                    -RS0.00
                </p>
            </div>
        </div>

        <h3>History</h3>
        <ul id="list" class="list">
            <!-- <li class="minus">
          Cash <span>-$400</span
          ><button class="delete-btn">x</button>
        </li> -->
        </ul>
        <h3>Insert New Transactions</h3>
        <form id="form">
            <div class="form-control">
                <label for="text">Transaction Name</label>
                <input type="text" id="text" placeholder="Enter Transaction Name...." />
            </div><br><br>
            <div class="form-control">
                <label for="amount">Amount <br> (For example, Income= 12 / Expense= -12)</label>
                <input type="number" id="amount" placeholder="Enter amount...">
            </div><br><br>
            <button id="sbutton" class="btn">Save Transaction</button>
            <span class="btnlog"><a href="logout.php" style="color:white" >Logout</a></span>
        </form>
        
    </div>
    
<script>
    //1
const balance = document.getElementById(
    "balance"
);
const money_plus = document.getElementById(
    "money-plus"
);
const money_minus = document.getElementById(
    "money-minus"
);
const list = document.getElementById("list");
const form = document.getElementById("form");
const text = document.getElementById("text");
const amount = document.getElementById("amount");
// const dummyTransactions = [
//   { id: 1, text: "Pet", amount: -Rs2000 },
//   { id: 2, text: "Salary", amount: Rs300 },
//   { id: 3, text: "Picture", amount: -Rs10 },
//   { id: 4, text: "Grant", amount: Rs150 },
// ];

// let transactions = dummyTransactions;

//last 
const localStorageTransactions = JSON.parse(localStorage.getItem('transactions'));

let transactions = localStorage.getItem('transactions') !== null ? localStorageTransactions : [];

//5
//Add Transaction
function addTransaction(e) {
    e.preventDefault();
    if (text.value.trim() === '' || amount.value.trim() === '') {
        alert('please add text and amount')
    } else {
        const transaction = {
            id: generateID(),
            text: text.value,
            amount: +amount.value
        }

        transactions.push(transaction);

        addTransactionDOM(transaction);
        updateValues();
        updateLocalStorage();
        text.value = '';
        amount.value = '';
    }
}


//5.5
//Generate Random ID
function generateID() {
    return Math.floor(Math.random() * 1000000000);
}

//2

//Add Trasactions to DOM list
function addTransactionDOM(transaction) {
    //GET sign
    const sign = transaction.amount < 0 ? "-" : "+";
    const item = document.createElement("li");

    //Add Class Based on Value
    item.classList.add(
        transaction.amount < 0 ? "minus" : "plus"
    );

    item.innerHTML = `
    ${transaction.text} <span>${sign}${Math.abs(
    transaction.amount
  )}</span>
    <button class="delete-btn" onclick="removeTransaction(${transaction.id})">x</button>
    `;
    list.appendChild(item);
}

//4

//This Function was used to update all the new values inserted by users
function updateValues() {
    const amounts = transactions.map(
        (transaction) => transaction.amount
    );
    const total = amounts
        .reduce((acc, item) => (acc += item), 0)
        .toFixed(2);
    const income = amounts
        .filter((item) => item > 0)
        .reduce((acc, item) => (acc += item), 0)
        .toFixed(2);
    const expense =
        (amounts
            .filter((item) => item < 0)
            .reduce((acc, item) => (acc += item), 0) *
            -1).toFixed(2);

    balance.innerText = `RS${total}`;
    money_plus.innerText = `RS${income}`;
    money_minus.innerText = `RS${expense}`;
}


//6 

//Remove Transaction by ID
function removeTransaction(id) {
    transactions = transactions.filter(transaction => transaction.id !== id);
    updateLocalStorage();
    Init();
}
//last
//update Local Storage Transaction
function updateLocalStorage() {
    localStorage.setItem('transactions', JSON.stringify(transactions));
}

//3

//Init App
function Init() {
    list.innerHTML = "";
    transactions.forEach(addTransactionDOM);
    updateValues();
}

Init();

form.addEventListener('submit', addTransaction);
</script>

</body>

</html>