// Membersihkan semua key/value pada search bar.
// window.onload = () => window.history.replaceState({}, document.title, window.location.pathname);

const modal_title = document.getElementById("modal_title");
const modal_button = document.getElementById("modal_button");
const input_name = document.getElementById("input_name");
const input_kelas = document.getElementById("input_kelas");
const input_jk = document.getElementById("input_jk");
const input_nis = document.getElementById("input_nis");
const array_nis = Array.from(document.querySelectorAll(
    "input[type='hidden'][name='nis']"
)).map(input => input.value);

document.getElementById("add_button").addEventListener("click", () => {
    modal_title.textContent = "Tambahkan Data";
    modal_button.textContent = "Tambah"
    modal_button.setAttribute("value", "add");
    input_nis.disabled = true;
    input_nis.innerHTML = "";
});

document.getElementById("edit_button").addEventListener("click", () => {
    modal_title.textContent = "Edit Data";
    modal_button.textContent = "Edit";
    modal_button.setAttribute("value", "update");
    input_nis.innerHTML = "";

    if (array_nis.length < 1) {
        input_nis.disabled = true;
        input_name.disabled = true;
        input_kelas.disabled = true;
        input_jk.disabled = true;
    } else {
        input_nis.disabled = false;
        array_nis.forEach(item => {
            const option = document.createElement("option");
            option.value = item;
            option.text = item;
            input_nis.appendChild(option);
        });
    };
});

// input_nis.addEventListener("change", (event) => {
//     console.log("astagfirullah");
//     const nis = event.target.value;
//     const rows = document.querySelectorAll("#main_table tbody tr");

//     rows.forEach(row => {
//         const cells = row.getElementsByTagName('td');

//         if (cells[0].textContent === nis) {
//             input_name.textContent = cells[1].textContent;
//             // input_kelas.textContent = cells[2].textContent;
//         };
//     });
// })