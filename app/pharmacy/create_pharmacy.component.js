window.CreatePharmacyComponent = React.createClass({
// initialize values
getInitialState: function() {
    return {
        name: '',
        address: '',
        city: '',
        state: '',
        zip: '',
        lat: '',
        lng: '',
        successCreation: null
    };
},
 

componentDidMount: function() {
 
    $('.page-header h1').text('Create pharmacy');
},
 
componentWillUnmount: function() {
    this.serverRequest.abort();
},
 
// handle name change
onNameChange: function(e) {
    this.setState({name: e.target.value});
},
 
// handle address change
onAddressChange: function(e) {
    this.setState({address: e.target.value});
},
 
// handle city change
onCityChange: function(e) {
    this.setState({city: e.target.value});
},

// handle state change
onStateChange: function(e) {
    this.setState({state: e.target.value});
},

// handle zip change
onZipChange: function(e) {
    this.setState({zip: e.target.value});
},

// handle lat change
onLatChange: function(e) {
    this.setState({lat: e.target.value});
},

// handle lng change
onLngChange: function(e) {
    this.setState({lng: e.target.value});
},
 
// handle save button clicked
onSave: function(e){
 
    // data in the form
    var form_data={
        name: this.state.name,
        address: this.state.address,
        city: this.state.city,
        state: this.state.state,
        zip: this.state.zip,
        lng: this.state.lng,
        lat: this.state.lat
    };
 
    // submit form data to api
    $.ajax({
        url: "http://localhost/rx_finder/create.php",
        type : "POST",
        contentType : 'application/json',
        data : JSON.stringify(form_data),
        success : function(response) {
 
            // api message
            this.setState({successCreation: response['message']});
 
            // empty form
            this.setState({name: ""});
            this.setState({address: ""});
            this.setState({city: ""});
            this.setState({state: ""});
            this.setState({zip: ""});
            this.setState({lat: ""});
            this.setState({lng: ""});
 
        }.bind(this),
        error: function(xhr, resp, text){
            // show error to console
            console.log(xhr, resp, text);
        }
    });
 
    e.preventDefault();
},
 
render: function() {
 

 
    /*
    - tell the user if a pharmacy was created
    - tell the user if unable to create pharmacy
    - button to go back to pharmacies list
    - form to create a pharmacy
    */
    return (
    <div>
        {
 
            this.state.successCreation == "Pharmacy was created." ?
                <div className='alert alert-success'>
                    Pharmacy was saved.
                </div>
            : null
        }
 
        {
 
            this.state.successCreation == "Unable to create pharmacy." ?
                <div className='alert alert-danger'>
                    Unable to save pharmacy. Please try again.
                </div>
            : null
        }
 
        <a href='#'
            onClick={() => this.props.changeAppMode('read')}
            className='btn btn-primary margin-bottom-1em'> Read Pharmacies
        </a>
 
 
        <form onSubmit={this.onSave}>
            <table className='table table-bordered table-hover'>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>
                        <input
                        type='text'
                        className='form-control'
                        value={this.state.name}
                        required
                        onChange={this.onNameChange} />
                    </td>
                </tr>
 
                <tr>
                    <td>Address</td>
                    <td>
                        <textarea
                        type='text'
                        className='form-control'
                        required
                        value={this.state.address}
                        onChange={this.onAddressChange}>
                        </textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>City</td>
                    <td>
                        <textarea
                        type='text'
                        className='form-control'
                        required
                        value={this.state.city}
                        onChange={this.onCityChange}>
                        </textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>State</td>
                    <td>
                        <textarea
                        type='text'
                        className='form-control'
                        required
                        value={this.state.state}
                        onChange={this.onStateChange}>
                        </textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Zip</td>
                    <td>
                        <textarea
                        type='text'
                        className='form-control'
                        required
                        value={this.state.zip}
                        onChange={this.onZipChange}>
                        </textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Latitude</td>
                    <td>
                        <textarea
                        type='text'
                        className='form-control'
                        required
                        value={this.state.lat}
                        onChange={this.onLatChange}>
                        </textarea>
                    </td>
                </tr>
					
					<tr>
                    <td>Longtitude</td>
                    <td>
                        <textarea
                        type='text'
                        className='form-control'
                        required
                        value={this.state.longtitude}
                        onChange={this.onLngChange}>
                        </textarea>
                    </td>
                </tr>                
                
                <tr>
                    <td></td>
                    <td>
                        <button
                        className='btn btn-primary'
                        onClick={this.onSave}>Save</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    );
}
});