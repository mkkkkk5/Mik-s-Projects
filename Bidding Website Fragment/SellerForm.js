import React, { useContext,useState,useEffect } from 'react'
import db from '../db'
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import Button from "components/CustomButtons/Button.js";
import Card from "components/Card/Card.js";
import CardBody from "components/Card/CardBody.js";
import CardHeader from "components/Card/CardHeader.js";
import CardFooter from "components/Card/CardFooter.js";
import Checkbox from '@material-ui/core/Checkbox';

import UserContext from '../UserContext'
import {
    Link
} from "react-router-dom";

import styles from "assets/jss/material-kit-react/views/loginPage.js";

//import image from "assets/img/bg7.jpg";
// import ProfilePage from '../../views/ProfilePage/ProfilePage';

const useStyles = makeStyles(styles);

export default function SellerForm() {
    const [cardAnimaton, setCardAnimation] = useState("cardHidden");
    useEffect(() => {
        const clear = setTimeout(() => setCardAnimation(""), 700)
        return () => clearTimeout(clear) // function that cancels the timeout
    }, [])
    const classes = useStyles();

    // const [email, setEmail] = useState("")
    // const [name, setName] = useState("")
    // const [address, setAddress] = useState("")
    // const [avatar, setAvatar] = useState("")
    // // const [userType, setUserType] = useState("")
    // const [userRole, setUserRole] = useState("")

    // const history = useHistory()
    
    const { user } = useContext(UserContext)
    const [checked, setChecked] = useState(false)

    const handleChange = (event) => {
        setChecked(event.target.checked)
    }

    const submit = async () => {
       if (checked === true){
           await db.Users.update({ ...user, id: user.id,  role: "seller"})
           
       }
       else{
           //console.log("not submitting...")
       }

    }

    // const valid = () => user.role === "seller"
        
    return (
        // <div>

        //     <div
        //         className={classes.pageHeader}
        //         // style={{
        //         //   //  backgroundImage: "url(" + image + ")",
        //         //     backgroundSize: "cover",
        //         //     backgroundPosition: "top center"
        //         // }}
        //     >
                <div className={classes.container}>
                    <GridContainer justify="center">
                        <GridItem xs={12}>
                            <Card className={classes[cardAnimaton]}>
                                <form className={classes.form}>
                                    <CardHeader color="info" className={classes.cardHeader}>
                                        <h4>Seller Form</h4>
                                    </CardHeader>
                                    <p className={classes.divider}>Please enter your information</p>
                                    <CardBody>
                                        <p>I want to change my role to be a seller. </p>
                                        <Checkbox
                                            checked={checked}
                                            onChange={handleChange}
                                            color="default"
                                            inputProps={{ 'aria-label': 'checkbox with default color' }}
                                        />

                                    </CardBody>
                                    <CardFooter className={classes.cardFooter}>
                                        <Button disabled={user.role === "seller"} simple color="success" size="lg" onClick={submit} component={Link} to={`/`}>
                                            Submit Form
                    </Button>
                                    </CardFooter>
                                </form>
                            </Card>
                        </GridItem>
                    </GridContainer>
                </div>
        //     </div>
        // </div>
    );
}
