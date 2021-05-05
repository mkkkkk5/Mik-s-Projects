import React, { useState ,useEffect} from 'react'
import fb from '../fb'
import { useHistory } from 'react-router-dom';
import db from '../db'


// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import InputAdornment from "@material-ui/core/InputAdornment";
import Icon from "@material-ui/core/Icon";
// @material-ui/icons
import Email from "@material-ui/icons/Email";
import People from "@material-ui/icons/People";
// core components
import Footer from "components/Footer/Footer.js";
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import Button from "components/CustomButtons/Button.js";
import Card from "components/Card/Card.js";
import CardBody from "components/Card/CardBody.js";
import CardHeader from "components/Card/CardHeader.js";
import CardFooter from "components/Card/CardFooter.js";
import CustomInput from "components/CustomInput/CustomInput.js";
import InsertPhotoIcon from '@material-ui/icons/InsertPhoto';

import { Fab } from "@material-ui/core";


import styles from "assets/jss/material-kit-react/views/loginPage.js";

import image from "assets/img/registerAuction.png";

const useStyles = makeStyles(styles);

export default function Register() {
    const [cardAnimaton, setCardAnimation] = useState("cardHidden");
    useEffect(() => {
        const clear = setTimeout(() => setCardAnimation(""), 700)
        return () => clearTimeout(clear) // function that cancels the timeout
    }, [])
    const classes = useStyles();

    const [email, setEmail] = useState("")
    const [password, setPassword] = useState("")
    const [password2, setPassword2] = useState("")
    const [name, setName] = useState("")
    const [address, setAddress] = useState("")
    const [avatar] = useState("")
    // const [userType, setUserType] = useState("")
    //const [userRole, setUserRole] = useState("")

    const history = useHistory()
    //  const [user, setUser] = useState(null)
    //const [userInfo, setUserInfo] = useState({})
    const [eventAvatar, setEventAvatar] = useState(null)
    const register = async () => {
        if (password === password2) {
            try {
                await fb.auth().createUserWithEmailAndPassword(email, password)
                await db.Chats.create({ supportId: "", userId: fb.auth().currentUser.uid, status: "" })
                await db.Users.update({
                    id: fb.auth().currentUser.uid, name,
                    avatar: "", address, role: "buyer", balance: 0
                })
                // setUser(await fb.auth().currentUser.uid)
                await uploadAvatar(eventAvatar)
                history.push("/")
            } catch (error) {
                alert(error.message)
            }
        }
    }

    const tryToUpload = async event => {
        setEventAvatar(event.target.files[0])
    }

    const uploadAvatar = async event => {
        if (event) {
            const filenameRef = fb.storage().ref().child(`avatars/${fb.auth().currentUser.uid}`)
            const snapshot = await filenameRef.put(event)
            // put file url in user object and upload to db
            const avatar = await snapshot.ref.getDownloadURL()
            await db.Users.update({ id: fb.auth().currentUser.uid, name, avatar, address, role: "buyer",balance:0 })
        }
    }

    const valid = () =>
        // user !==""&&
        email !== "" &&
        password !== "" &&
        password2 !== "" &&
        name !== "" &&
        address !== ""
    return (
        <div>

            <div
                className={classes.pageHeader}
                style={{
                    backgroundImage: "url(" + image + ")",
                    backgroundSize: "cover",
                    backgroundPosition: "top center"
                }}
            >
                <div className={classes.container}>
                    <GridContainer justify="center">
                        <GridItem xs={12} sm={12} md={4}>
                            <Card className={classes[cardAnimaton]}>
                                <form className={classes.form}>
                                    <CardHeader color="info" className={classes.cardHeader}>
                                        <h4>Register</h4>
                                    </CardHeader>
                                    <p className={classes.divider}>Please enter your information</p>
                                    <CardBody>
                                        <CustomInput
                                            labelText="Full Name"
                                            id="name"
                                            formControlProps={{
                                                fullWidth: true
                                            }}
                                            inputProps={{

                                                onChange: event => setName(event.target.value),
                                                value: name,
                                                type: "text",
                                                endAdornment: (
                                                    <InputAdornment position="end" >
                                                        <People className={classes.inputIconsColor} />
                                                    </InputAdornment>
                                                ),
                                                autoComplete: "off"
                                            }}
                                        />
                                        <CustomInput
                                            labelText="Address"
                                            id="address"
                                            formControlProps={{
                                                fullWidth: true
                                            }}
                                            inputProps={{
                                                onChange: event => setAddress(event.target.value),
                                                value: address,
                                                type: "text",
                                                endAdornment: (
                                                    <InputAdornment position="end">
                                                        <People className={classes.inputIconsColor} />
                                                    </InputAdornment>
                                                ),
                                                autoComplete: "off"
                                            }}
                                        />
                                        <img src={avatar} alt="avatar" style={{ width: '100px', height: '100px ' }} round={"true"} />
                                        <label htmlFor="upload-photo">
                                            <input
                                                style={{ display: "none" }}
                                                id="upload-photo"
                                                name="upload-photo"
                                                type="file"
                                                onChange={tryToUpload}
                                            />
                                            <Fab  size="small" style={{ float: "right" }} component="span" aria-label="add">
                                                <InsertPhotoIcon />
                                            </Fab>
                                        </label>
                                        <CustomInput
                                            labelText="Email"
                                            id="email"
                                            formControlProps={{
                                                fullWidth: true
                                            }}
                                            inputProps={{
                                                onChange: event => setEmail(event.target.value),
                                                value: email,
                                                type: "email",
                                                endAdornment: (
                                                    <InputAdornment position="end">
                                                        <Email className={classes.inputIconsColor} />
                                                    </InputAdornment>
                                                )
                                            }}
                                        />
                                        <CustomInput
                                            labelText="Password"
                                            id="password"
                                            formControlProps={{
                                                fullWidth: true
                                            }}
                                            inputProps={{
                                                onChange: event => setPassword(event.target.value),
                                                value: password,
                                                type: "password",
                                                endAdornment: (
                                                    <InputAdornment position="end">
                                                        <Icon className={classes.inputIconsColor}>
                                                            lock_outline
                                                        </Icon>
                                                    </InputAdornment>
                                                ),
                                                autoComplete: "off"
                                            }}
                                        />
                                        <CustomInput
                                            labelText="Re-enter Password"
                                            id="password2"
                                            formControlProps={{
                                                fullWidth: true
                                            }}
                                            inputProps={{
                                                onChange: event => setPassword2(event.target.value),
                                                value: password2,
                                                type: "password",
                                                endAdornment: (
                                                    <InputAdornment position="end">
                                                        <Icon className={classes.inputIconsColor}>
                                                            lock_outline
                                                        </Icon>
                                                    </InputAdornment>
                                                ),
                                                autoComplete: "off"
                                            }}
                                        />
                                    </CardBody>
                                    <CardFooter className={classes.cardFooter}>
                                        <Button disabled={!valid()} simple color="success" size="lg" onClick={register} >
                                            Register
                    </Button>
                                    </CardFooter>
                                </form>
                            </Card>
                        </GridItem>
                    </GridContainer>
                </div>
                <Footer whiteFont />
            </div>
        </div>
    );
}
