document.addEventListener('DOMContentLoaded', function() {
    insertFooter();
});

function insertFooter() {
    var footer = document.querySelector("footer");

    footer.innerHTML = `
    <div class="footer">
            <div class="footerSection">
              <h2>Contact Us</h2>
              <br>
              <li><strong>Location:</strong> 202-208 Nepean Highway, Parkdale 3195</li>
              <br>
              <li><strong>Phone:</strong> 03 8510 7697</li>
              <br>
              <li><strong>Email:</strong> <a href="mailto:delhiclub.parkdale@gmail.com">delhiclub.parkdale@gmail.com</a></li>
              <br><br>
            </div>
            <div class="footerSection">
                <h2>Opening Hours</h2>
                <table>
                    <tr>
                        <th></th>
                        <th>Open Time</th>
                        <th>Close Time</th>
                    </tr>
                    <tr>
                        <th>Monday</th>
                        <td>Closed</td>
                        <td>Closed</td>
                    </tr>
                    <tr>
                        <th>Tuesday</th>
                        <td>5:00pm</td>
                        <td>10:00pm</td>
                    </tr>
                    <tr>
                        <th>Wednesday</th>
                        <td>5:00pm</td>
                        <td>10:00pm</td>
                    </tr>
                    <tr>
                        <th>Thursday</th>
                        <td>5:00pm</td>
                        <td>10:00pm</td>
                    </tr>
                    <tr>
                        <th>Friday</th>
                        <td>5:00pm</td>
                        <td>10:00pm</td>
                    </tr>
                    <tr>
                        <th>Saturday</th>
                        <td>5:00pm</td>
                        <td>10:00pm</td>
                    </tr>
                    <tr>
                        <th>Sunday</th>
                        <td>5:00pm</td>
                        <td>10:00pm</td>
                    </tr>
                </table>
            </div>
            <div class="footerSection">
                  <h2>Location</h2>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d201253.2293510519!2d145.02307876601046!3d-37.986890016708045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad66d380398b02d%3A0xa277c024054a1885!2sDELHI%20CLUB%20INDIAN%20RESTAURANT%20%26%20BAR!5e0!3m2!1sen!2sau!4v1712721269884!5m2!1sen!2sau" style="border:0;"></iframe>
            </div>
        </div>
    `;
}