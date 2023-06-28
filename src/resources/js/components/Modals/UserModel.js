export class UserModel {
    /**
     * @param {string} fullName
     * @param {string} lastName
     * @param {string} firstName
     * @param {string} surName
     * @param {string} phone
     * @param {string} address
     * @param {string} city
     * @param {null|string} uuid
     */
    constructor(
        fullName = '',
        lastName = '',
        firstName = '',
        surName = '',
        phone= '',
        address= '',
        city = '',
        uuid = null,
    ) {
        this.fullName = fullName;
        this.lastName = lastName;
        this.firstName = firstName;
        this.surName = surName;
        this.phone = phone;
        this.address = address;
        this.city = city;
        this.uuid = uuid;
    }
}
