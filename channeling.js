//channeling section
function showTimetable(department) {
    // Remove 'selected' class from all buttons
    const buttons = document.querySelectorAll('.department-btn');
    buttons.forEach(button => button.classList.remove('selected'));

    // Add 'selected' class to the clicked button
    const selectedButton = document.querySelector(`.department-btn[onclick="showTimetable('${department}')"]`);
    if (selectedButton) {
        selectedButton.classList.add('selected');
    } else {
        console.error(`Button not found for department: ${department}`);
        return;
    }

    const timetableContent = document.getElementById('timetable-content');
    if (!timetableContent) {
        console.error('Timetable content element not found.');
        return;
    }

    let content = '';

    if (department === 'Cardiology') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Godvin Constantine</td>
                        <td>Monday</td>
                        <td>17:30 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Narenthiran</td>
                        <td>Wednesday</td>
                        <td>12:30 - 15:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Godvin Constantine</td>
                        <td>Wednesday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. M.H.M.Zacky</td>
                        <td>Saturday</td>
                        <td>12:00 - 15:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Psychiatrists') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. (MRS) Dasanthi Akmeemana</td>
                        <td>Monday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS) Dasanthi Akmeemana</td>
                        <td>Wednesday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS) Dasanthi Akmeemana</td>
                        <td>Thursday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS) Dasanthi Akmeemana</td>
                        <td>Saturday</td>
                        <td>14:00 - 17:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S. Sivadas</td>
                        <td>Sunday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Ent Surgeon') {
        content = `
        <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. K.G.N.Seneviratne</td>
                        <td>Monday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Sakaff</td>
                        <td>Monday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>Dr. R.S.Drhaman</td>
                        <td>Tuesday</td>
                        <td>12:00 - 15:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Seevaratnam</td>
                        <td>Tuesday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.G.N.Seneviratne</td>
                        <td>Wednesday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Sakaff</td>
                        <td>Wednesday</td>
                        <td>20:30 - 23:30</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Seevaratnam</td>
                        <td>Thursday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>Dr. K.G.N.Seneviratne</td>
                        <td>Friday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. R.S.Drhaman</td>
                        <td>Saturday</td>
                        <td>12:00 - 15:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Seevaratnam</td>
                        <td>Saturday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS).Selvi Vettivelu</td>
                        <td>Sunday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Gynaecologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. (MRS)Gowry.P.Senthilanathan</td>
                        <td>Monday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)A.R.J.P.Niyas</td>
                        <td>Monday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Monday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Monday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Prathapan</td>
                        <td>Monday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Asogan</td>
                        <td>Monday</td>
                        <td>20:00 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Prof. Harshalal Senevirathna</td>
                        <td>Tuesday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Pro. S.F.L.Akbar</td>
                        <td>Tuesday</td>
                        <td>09:00 - 12:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Gowry.P.Senthilanathan</td>
                        <td>Tuesday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)A.R.J.P.Niyas</td>
                        <td>Tuesday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Tuesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Tuesday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Sriskanthan</td>
                        <td>Tuesday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Asogan</td>
                        <td>Tuesday</td>
                        <td>20:00 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Prof. Harshalal Senevirathna</td>
                        <td>Wednesday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sunil Kulathunga</td>
                        <td>Wednesday</td>
                        <td>14:00 - 17:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)A.R.J.P.Niyas</td>
                        <td>Wednesday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Wednesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Wednesday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Prathapan</td>
                        <td>Wednesday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sunil Kulathunga</td>
                        <td>Thursday</td>
                        <td>07:30 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Pro. S.F.L.Akbar</td>
                        <td>Thursday</td>
                        <td>09:00 - 12:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Gowry.P.Senthilanathan</td>
                        <td>Thursday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)A.R.J.P.Niyas</td>
                        <td>Thursday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Thursday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Thursday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sunil Kulathunga</td>
                        <td>Friday</td>
                        <td>07:30 - 10:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Harshalal Senevirathna</td>
                        <td>Friday</td>
                        <td>08:30 - 11:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)A.R.J.P.Niyas</td>
                        <td>Friday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Friday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Friday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Prathapan</td>
                        <td>Friday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Prof. Harshalal Senevirathna</td>
                        <td>Saturday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Asogan</td>
                        <td>Saturday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Saturday</td>
                        <td>12:00 - 15:00</td>
                    </tr>
                    <tr>
                        <td>Pro. S.F.L.Akbar</td>
                        <td>Saturday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Prathapan</td>
                        <td>Saturday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Gowry.P.Senthilanathan</td>
                        <td>Saturday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Saturday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sunil Kulathunga</td>
                        <td>Sunday</td>
                        <td>08:30 - 11:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Rani Sithambarapilla</td>
                        <td>Sunday</td>
                        <td>10:30 - 13:30</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Asogan</td>
                        <td>Sunday</td>
                        <td>10:30 - 13:30</td>
                    </tr>
                    <tr>
                        <td>Pro. S.F.L.Akbar</td>
                        <td>Sunday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)A.R.J.P.Niyas</td>
                        <td>Sunday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sanath .P.Akmeemana</td>
                        <td>Sunday</td>
                        <td>20:00 - 23:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Oncological Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr.Ariyathurai Parthiepan</td>
                        <td>Monday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr.Ariyathurai Parthiepan</td>
                        <td>Wednesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr.Ariyathurai Parthiepan</td>
                        <td>Friday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Peadiatric Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Chandima Suriyarachchi</td>
                        <td>Monday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Chandima Suriyarachchi</td>
                        <td>Tuesday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Chandima Suriyarachchi</td>
                        <td>Wednesday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Chandima Suriyarachchi</td>
                        <td>Thursday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Chandima Suriyarachchi</td>
                        <td>Friday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Rheumatalogist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. J.V.Ariyasinghei</td>
                        <td>Wednesday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Dr. J.V.Ariyasinghe</td>
                        <td>Saturday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MS)Ushagowry Saravanamuttu</td>
                        <td>Saturday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. J.V.Ariyasinghei</td>
                        <td>Sunday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Urologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Manjula Wijewardena</td>
                        <td>Monday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Manjula Wijewardena</td>
                        <td>Saturday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Chest Physcian') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Aflah Sadikeen</td>
                        <td>Monday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Rishikesavan</td>
                        <td>Friday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Muhunthan</td>
                        <td>Saturday</td>
                        <td>08:30 - 11:30</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Rishikesavan</td>
                        <td>Saturday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Rishikesavan</td>
                        <td>Sunday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Diabetic specialist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. M.S.M.Firdous</td>
                        <td>Friday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Eye Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Sujatha Pathirage</td>
                        <td>Monday</td>
                        <td>08:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)M.Mithrakuma</td>
                        <td>Monday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Vasuki Gurusamy</td>
                        <td>Monday</td>
                        <td>15:15 - 18:15</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Mareena Reffai</td>
                        <td>Monday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Sujatha Pathirage</td>
                        <td>Tuesday</td>
                        <td>08:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Vasuki Gurusamy</td>
                        <td>Tuesday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Mareena Reffai</td>
                        <td>Tuesday</td>
                        <td>18:30 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sujatha Pathirage</td>
                        <td>Wednesday</td>
                        <td>08:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Mareena Reffai</td>
                        <td>Wednesday</td>
                        <td>18:30 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sujatha Pathirage</td>
                        <td>Thursday</td>
                        <td>08:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Mareena Reffai</td>
                        <td>Thursday</td>
                        <td>18:30 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sujatha Pathirage</td>
                        <td>Friday</td>
                        <td>08:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Mareena Reffai</td>
                        <td>Friday</td>
                        <td>18:30 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Sujatha Pathirage</td>
                        <td>Saturday</td>
                        <td>13:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Mareena Reffai</td>
                        <td>Saturday</td>
                        <td>18:30 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Vasuki Gurusamy</td>
                        <td>Sunday</td>
                        <td>12:00 - 15:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Nephrologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. S.Mathu</td>
                        <td>Tuesday</td>
                        <td>20:15 - 23:15</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Oncologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr.Nadarajah Jeyakumaran</td>
                        <td>Monday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr.(MS)Umagowry Sarawanamuththu</td>
                        <td>Thursday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr.Nadarajah Jeyakumaran</td>
                        <td>Saturday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr.(MS)Umagowry Sarawanamuththu</td>
                        <td>Saturday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Peadiatrician') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. (MS)Kala Somasundaram</td>
                        <td>Monday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Sekar</td>
                        <td>Monday</td>
                        <td>09:00 - 12:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Monday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Samantha Chandimal Jayawardena</td>
                        <td>Monday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Priyanthi Molligoda</td>
                        <td>Tuesday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Thamodani Liyanage</td>
                        <td>Tuesday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Tuesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MS)Kala Somasundaram</td>
                        <td>Tuesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr. Priyanthi Molligoda</td>
                        <td>Wednesday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Thamodani Liyanage</td>
                        <td>Wednesday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Wednesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Samantha Chandimal Jayawardena</td>
                        <td>Wednesday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Priyanthi Molligoda</td>
                        <td>Thursday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Thamodani Liyanage</td>
                        <td>Thursday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Thursday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Samantha Chandimal Jayawardena</td>
                        <td>Thursday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Priyanthi Molligoda</td>
                        <td>Friday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Thamodani Liyanage</td>
                        <td>Friday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Friday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Samantha Chandimal Jayawardena</td>
                        <td>Friday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MS)Kala Somasundaram</td>
                        <td>Saturday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Sekar</td>
                        <td>Saturday</td>
                        <td>13:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Saturday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Ajanthan</td>
                        <td>Sunday</td>
                        <td>08:45 - 11:45</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Sekar</td>
                        <td>Sunday</td>
                        <td>13:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Sivakumar</td>
                        <td>Sunday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. (MS)Kala Somasundaram</td>
                        <td>Sunday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Sports Medicine') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr.Padmalal Pathirage</td>
                        <td>Monday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr.Padmalal Pathirage</td>
                        <td>Tuesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr.Padmalal Pathirage</td>
                        <td>Wednesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr.Padmalal Pathirage</td>
                        <td>Thursday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr.Padmalal Pathirage</td>
                        <td>Friday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Vaccinologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. (MRS)Omala Wimalaratne</td>
                        <td>Saturday</td>
                        <td>09:00 - 12:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Dental Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. P.Kirupakaran/td>
                        <td>Monday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. P.Kirupakaran/td>
                        <td>Thursday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Diabetologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Henry.N.Rajaratnam</td>
                        <td>Tuesday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Henry.N.Rajaratnam</td>
                        <td>Thursday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Henry.N.Rajaratnam</td>
                        <td>Saturday</td>
                        <td>09:00 - 12:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'General Physician') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Monday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Monday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Monday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Monday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Tuesday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Tuesday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Tuesday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Tuesday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Wednesday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Wednesday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Wednesday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Wednesday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Thursday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Thursday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Thursday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Thursday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Friday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Friday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Friday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Friday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Saturday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Saturday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Saturday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Saturday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                    <tr>
                        <td>PRO.J. Indrakumar</td>
                        <td>Sunday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>DR. S.Mangaleshwaran</td>
                        <td>Sunday</td>
                        <td>09:00 - 16:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (Mrs)T.Rajshankar</td>
                        <td>Sunday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Veerasudhan</td>
                        <td>Sunday</td>
                        <td>19:30 - 22:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Orthopaedic Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. R.Gnanasekeram</td>
                        <td>Monday</td>
                        <td>20:30 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Dr. J.Jeyakumar</td>
                        <td>Tuesday</td>
                        <td>20:30 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Sritharan</td>
                        <td>Wednesday</td>
                        <td>12:00 - 15:00</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Gnanasekeram</td>
                        <td>Wednesday</td>
                        <td>20:30 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Dr. J.Jeyakumar</td>
                        <td>Thursday</td>
                        <td>20:30 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Swarnakumar</td>
                        <td>Friday</td>
                        <td>07:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>Dr. S.Sritharan</td>
                        <td>Friday</td>
                        <td>14:00 - 17:00</td>
                    </tr>
                    <tr>
                        <td>Dr. J.Jeyakumar</td>
                        <td>Friday</td>
                        <td>20:30 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Dr. R.Gnanasekeram</td>
                        <td>Saturday</td>
                        <td>15:30 - 18:30</td>
                    </tr>
                    <tr>
                        <td>Dr. J.Jeyakumar</td>
                        <td>Sunday</td>
                        <td>14:00 - 17:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Phsyciatric Councelling') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mrs. Yashoda Ratnapala</td>
                        <td>Monday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Mrs. Yashoda Ratnapala</td>
                        <td>Wednesday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                    <tr>
                        <td>Mrs. Yashoda Ratnapala</td>
                        <td>Thursday</td>
                        <td>08:00 - 11:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Thoracic Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. D.M.S.Handagala</td>
                        <td>Wednesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr. D.M.S.Handagala</td>
                        <td>Sunday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Vascular & Transplant Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr.Thanoj Fernando</td>
                        <td>Saturday</td>
                        <td>17:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Dr.Joel Arudchelvam</td>
                        <td>Sunday</td>
                        <td>15:00 - 18:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Dermatologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. K.Satgurunathan</td>
                        <td>Monday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Satgurunathan</td>
                        <td>Tuesday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Satgurunathan</td>
                        <td>Wednesday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Satgurunathan</td>
                        <td>Thursday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Satgurunathan</td>
                        <td>Friday</td>
                        <td>11:00 - 14:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Dieticions & Nutrician') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mrs.Iqbal</td>
                        <td>Monday</td>
                        <td>09:30 - 12:30</td>
                    </tr>
                    <tr>
                        <td>Mrs.Iqbal</td>
                        <td>Tuesday</td>
                        <td>09:30 - 12:30</td>
                    </tr>
                    <tr>
                        <td>Mrs.Iqbal</td>
                        <td>Thursday</td>
                        <td>09:30 - 12:30</td>
                    </tr>
                    <tr>
                        <td>Mrs.Iqbal</td>
                        <td>Friday</td>
                        <td>09:30 - 12:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'General Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Monday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Monday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Monday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Monday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Monday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Tuesday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Tuesday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Tuesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Tuesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Tuesday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Wednesday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Wednesday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Wednesday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Wednesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Wednesday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Thursday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Thursday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Thursday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Thursday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Thursday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Friday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Friday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Friday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Friday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Friday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Saturday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Saturday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Saturday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Saturday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Saturday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. K.Alagaratnam</td>
                        <td>Sunday</td>
                        <td>10:00 - 13:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Thevarajah Bhishman</td>
                        <td>Sunday</td>
                        <td>10:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Dr. V.Suthagaran</td>
                        <td>Sunday</td>
                        <td>16:00 - 19:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajiv.G. Rajendran</td>
                        <td>Sunday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Prof. Deepaka Weerasekara</td>
                        <td>Sunday</td>
                        <td>19:00 - 21:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Neuro Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. T.Rajakaruna</td>
                        <td>Monday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Rajakaruna</td>
                        <td>Tuesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Rajakaruna</td>
                        <td>Wednesday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Rajakaruna</td>
                        <td>Thursday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                    <tr>
                        <td>Dr. T.Rajakaruna</td>
                        <td>Friday</td>
                        <td>17:30 - 20:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Peadiatric Neonatalogist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Rajeev Sathanandaraja</td>
                        <td>Monday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajeev Sathanandaraja</td>
                        <td>Thursday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajeev Sathanandaraja</td>
                        <td>Friday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Dr. Rajeev Sathanandaraja</td>
                        <td>Saturday</td>
                        <td>18:00 - 21:00</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Psychiatrists') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. (MRS)Dasanthi Akmeemana</td>
                        <td>Monday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Dasanthi Akmeemana</td>
                        <td>Wednesday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Dasanthi Akmeemana</td>
                        <td>Thursday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Dasanthi Akmeemana</td>
                        <td>Saturday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Dasanthi Akmeemana</td>
                        <td>Sunday</td>
                        <td>18:30 - 21:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Urologist - Kidney Transplant Surgeon') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr.Kumaradasan Umashankar</td>
                        <td>Wednesday</td>
                        <td>07:30 - 10:30</td>
                    </tr>
                    <tr>
                        <td>Dr.Kumaradasan Umashankar</td>
                        <td>Sunday</td>
                        <td>07:30 - 10:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    } else if (department === 'Venereologist') {
        content = `
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. (MRS)Sathya Herath</td>
                        <td>Tuesday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                    <tr>
                        <td>Dr. (MRS)Sathya Herath</td>
                        <td>Thursday</td>
                        <td>16:30 - 19:30</td>
                    </tr>
                </tbody>
            </table>
        `;
    }

    timetableContent.innerHTML = content;
};

// Call showTimetable function with 'cardiology' on page load
window.onload = function () {
    showTimetable('Cardiology');
};