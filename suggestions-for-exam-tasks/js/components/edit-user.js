import { LitElement, html, css } from "../../node_modules/lit-element/lit-element.js";

class EditUser extends LitElement {
  static get properties() {
    return {
      user: { type: Object }
    };
  }

  constructor() {
    super();
  }

  static get styles() {
    return css`
      input { margin-bottom: 20px; }
    `;
  }

  updateUser() {
    const data = new FormData();
    data.append('uid', this.user.uid);
    data.append('uname', this.user.uname);
    data.append('firstName', this.user.firstName);
    data.append('lastName', this.user.lastName);
    data.append('oldpwd', this.user.oldPwd);
    data.append('pwd', this.user.pwd);

    fetch('api/updateUser.php', {
      method: 'POST',
      body: data
    })
    .then(response => response.json())
    .then(data => console.log(data));
  }

  render() {
    return html`
      <label>Brukernavn (e-post)</label><br>
      <input type="text" .value="${this.user.uname}" @input="${(e) => this.user.uname = e.target.value}"><br>

      <label>Fornavn</label><br>
      <input type="text" .value="${this.user.firstName}" @input="${(e) => this.user.firstName = e.target.value}"><br>

      <label>Etternavn</label><br>
      <input type="text" .value="${this.user.lastName}" @input="${(e) => this.user.lastName = e.target.value}"><br>

      <label>Passord</label><br>
      <input type="password" .value="${this.user.oldPwd}" @input="${(e) => this.user.oldPwd = e.target.value}"><br>

      <label>Nytt passord</label><br>
      <input type="password" .value="${this.user.pwd}" @input="${(e) => this.user.pwd = e.target.value}"><br>

      <button type="submit" @click="${this.updateUser}">Update</button>
    `;
  }
}
customElements.define('edit-user', EditUser);
