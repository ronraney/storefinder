window.ReadOnePharmacyComponent = React.createClass({
	
getInitialState: function() {
    // Get this pharmacy's fields from the data attributes we set on the
    // #content div, using jQuery
    return {
        id: 0,
        name: '',
        address: '',
        city: '',
        state: '',
		  zip: '',
		  lat: '',
		  lng: ''
    };
},
 
// on mount, read pharmacy data and them as this component's state
componentDidMount: function(){
 
    var pharmacyId = this.props.pharmacyId;
 
    this.serverRequestPharm = $.get("http://localhost/rx_finder/read_one.php?id=" + pharmacyId,
        function (pharmacy) {
            this.setState({id: pharmacy.id});
            this.setState({name: pharmacy.name});
            this.setState({address: pharmacy.address});
            this.setState({city: pharmacy.city});
            this.setState({state: pharmacy.state});
            this.setState({zip: pharmacy.zip});
            this.setState({lat: pharmacy.lat});
            this.setState({lng: pharmacy.lng});
        }.bind(this));
 
    $('.page-header h1').text('Read Pharmacy');
},
 

componentWillUnmount: function() {
    this.serverRequestPharm.abort();
},
 
render: function() {
 
    return (
        <div>
            <a href='#'
                onClick={() => this.props.changeAppMode('read')}
                className='btn btn-primary margin-bottom-1em'>
                Read Pharmacies
            </a>
 
            <form onSubmit={this.onSave}>
                <table className='table table-bordered table-hover'>
                    <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{this.state.name}</td>
                    </tr>
 
                    <tr>
                        <td>Address</td>
                        <td>{this.state.address}</td>
                    </tr>
 
                    <tr>
                        <td>City</td>
                        <td>{this.state.city}</td>
                    </tr>
 
                    <tr>
                        <td>State</td>
                        <td>{this.state.state}</td>
                    </tr>
                    
                    <tr>
                        <td>Zip</td>
                        <td>{this.state.zip}</td>
                    </tr>
 
                    <tr>
                        <td>Latitude</td>
                        <td>{this.state.lat}</td>
                    </tr>
                    
                    <tr>
                        <td>Longtitude</td>
                        <td>{this.state.lng}</td>
                    </tr>
 
                    </tbody>
                </table>
            </form>
        </div>
    );
}
});