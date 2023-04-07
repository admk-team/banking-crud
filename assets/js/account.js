
const BASE_URL = "";

// Display user records when the page loads
window.onload = () => {
  getUsers();
};

// Function to get user records from API
function getUsers() {
  axios.get(`${BASE_URL}account/read.php`)
    .then(response => {
      const users = response.data.body;
      console.log(users);
      const tbody = document.querySelector("table tbody");
      tbody.innerHTML = "";
      for (let user of users) {
        tbody.innerHTML += `
          <tr>
            <td>${user.id}</td>
            <td>${user.user_id}</td>
            <td>${user.account_no}</td>
            <td>${user.bank_name}</td>
            <td>${user.branch_name}</td>
            <td>${user.branch_code}</td>
            <td>${user.account_type}</td>
            <td>${user.balance}</td>
          </tr>`;
      }
    })
    .catch(error => {
      console.error(error);
    });
}

// Function to add a new user to the API
document.querySelector("#add-user-account-form").addEventListener("submit", event => {
  event.preventDefault();

  const user_id = document.querySelector("#user-id").value;
  const account_no = document.querySelector("#account-no").value;
  const bank_name = document.querySelector("#bank-name").value;
  const branch_name = document.querySelector("#branch-name").value;
  const branch_code = document.querySelector("#branch-code").value;
  const account_type = document.querySelector("#account-type").value;
  const balance = document.querySelector("#balance").value;

  axios.post(`${BASE_URL}account/create.php`, { user_id ,account_no , bank_name , branch_name , branch_code , account_type , balance})
    .then(response =>{
  // Display success message and refresh user records
  document.querySelector("#messages").innerHTML = "User Account  added successfully";
  getUsers();
})
.catch(error => {
  // Display error message
  document.querySelector("#messages").innerHTML = "Error adding user account";
  console.error(error);
});
});


document.querySelector("#update-user-account-form").addEventListener("submit", event => {
event.preventDefault();

const id = document.querySelector("#update-id").value;
const user_id = document.querySelector("#update-user-id").value;

const account_no = document.querySelector("#update-account-no").value;
  const bank_name = document.querySelector("#update-bank-name").value;
  const branch_name = document.querySelector("#update-branch-name").value;
  const branch_code = document.querySelector("#update-branch-code").value;
  const account_type = document.querySelector("#update-account-type").value;
  const balance = document.querySelector("#update-balance").value;

axios.put(`${BASE_URL}account/update.php`, {id , user_id ,  account_no , bank_name , branch_name , branch_code , account_type , balance })
.then(response => {
  // Display success message and refresh user records
  document.querySelector("#messages").innerHTML = "User Account  updated successfully";
  getUsers();
})
.catch(error => {
  // Display error message
  document.querySelector("#messages").innerHTML = "Error updating user account ";
  console.error(error);
});
});

{/* 
// Function to update an existing user in the API */}
document.querySelector("#delete-user-account-form").addEventListener("submit", event => {
event.preventDefault();

const id = document.querySelector("#delete-id").value;

axios.post(`${BASE_URL}account/delete.php`, { id })
.then(response => {
  // Display success message and refresh user records
  document.querySelector("#messages").innerHTML = "User Account Deleted successfully";
  getUsers();
})
.catch(error => {
  // Display error message
  document.querySelector("#messages").innerHTML = "Error deleting user account";
  console.error(error);
});
});



