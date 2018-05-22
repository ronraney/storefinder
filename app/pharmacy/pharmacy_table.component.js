// component for the whole pharmacies table
window.PharmaciesTable = React.createClass({
    render: function() { 
    var rows = this.props.pharmacies
        .map(function(pharmacy, i) {
            return (
                <PharmacyRow
                    key={i}
                    pharmacy={pharmacy}
                    changeAppMode={this.props.changeAppMode} />
            );
        }.bind(this));
 
        return(
            !rows.length
                ? <div className='alert alert-danger'>No pharmacies found.</div>
                :
                <table className='table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                        </tr>
                    </thead>
                    <tbody>
                        {rows}
                    </tbody>
                </table>
        );
    }
});