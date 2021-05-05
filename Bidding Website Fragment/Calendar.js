import db from '../db'
import React, { useState, useEffect, useContext } from "react";
import UserContext from '../UserContext'
import { makeStyles } from "@material-ui/core/styles";
import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
import GridContainer from "../components/Grid/GridContainer";
import GridItem from "../components/Grid/GridItem.js";
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import CloudUploadIcon from '@material-ui/icons/CloudUpload';
// import SaveIcon from '@material-ui/icons/Save';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import Select from '@material-ui/core/Select';

import {
    Link
} from "react-router-dom";


//const useStyles = makeStyles(styles);

export default function Calendar() {
    const useStyles = makeStyles(styles);

    // const history = useHistory();

    const { user } = useContext(UserContext)

    const classes = useStyles();
    //Fields
    // const [calId, setCalId] = useState("")
    // const [userId,setUserId] = useState("")
    const [event, setEvent] = useState("")
    const [date, setDate] = useState(new Date())
    const [note, setNote] = useState("")

    const [userCalendar, setUserCalendar] = useState([])
    useEffect(() => db.Calendar.listenToCalendarByUserId(setUserCalendar, user.id), [user.id])

    const [auctions, setAuctions] = useState([])
    useEffect(() => db.Auctions.listenToUnfinished(setAuctions), [])

    const create = async () => {
        await db.Calendar.create({ userId: user.id, event: `Auction for ${event.itemId} item end date: ${event.finish.getDate()}/${event.finish.getMonth()}/${event.finish.getYear()}`, date: event.finish, note })
        setEvent("")
        setDate(new Date())
        setNote("")
    }

    // const edit = cal => {
    //     setCalId(cal.id)
    //     setEvent(cal.event)
    //     setDate(cal.date)
    //     setNote(cal.note)
    // }

    // const save = async () => {
    //     await db.Calendar.update({ id: calId, userId: user.id, event, date, note })
    //     setEvent("")
    //     setDate(new Date())
    //     setNote("")
    // }

    const remove = async (cal) => {
        await db.Calendar.remove(cal.id)
        // edit(cal)
    }

    // const [validCreate, setValidCreate] = useState(false)
    // useEffect(() => {
    //     const validateCreate = async () =>
    //         question.length > 0 &&
    //         answer.length > 0
    //     const getData = async () => {
    //         setValidCreate(await validateCreate())
    //     }
    //     getData()
    // }, [question, answer])

    // const [validSave, setValidSave] = useState(false)
    // useEffect(() => {
    //     const validateSave = async () =>
    //         note.length > 0 &&

    //         undefined !== await db.Calendar.findOne(calId)

    //     const getData = async () => {
    //         setValidSave(await validateSave())
    //     }
    //     getData()
    // }, [note, event,date])

    // const getItemName = (sellerId, itemId) => {
    //     db.Users.Items.listenToUserItem(setItem, sellerId, itemId)
    //     return item.name
    // }

    return (
        <div className={classes.section}>
            <GridContainer justify="center">
                <GridItem xs={12} sm={12} md={8}>
                    <h2 className={classes.title}>Calendar</h2>
                </GridItem>
            </GridContainer>
            <GridContainer>
                <TableContainer component={Paper}>
                    <Table aria-label="simple table">
                        <TableHead>
                            <TableRow>
                                {/* <TableCell align="right">Calender Id</TableCell>
                                <TableCell align="right">User Id</TableCell> */}
                                <TableCell align="right">Event</TableCell>
                                <TableCell align="right">Date</TableCell>
                                <TableCell align="right">Note</TableCell>
                                <TableCell align="right"></TableCell>

                            </TableRow>
                        </TableHead>
                        <TableBody>
                            <TableRow >
                                <TableCell align="right">
                                    {/* <TextField required id="event" label="Event" value={event} onChange={event => setEvent(event.target.value)} /> */}
                                    <InputLabel id="event">Event</InputLabel>
                                    <Select
                                        labelId="event"
                                        id="event"
                                        value={event}
                                        onChange={event => setEvent(event.target.value)}
                                    >
                                        {
                                            auctions.map(auction =>
                                                // <MenuItem key={auction.id} value={auction}>{`${getItemName(auction.sellerId, auction.itemId)} finished date ${auction.finish}`}</MenuItem>
                                                <MenuItem key={auction.id} value={auction}>
                                                    {`Auction for ${auction.itemId} item end date: ${auction.finish.getDate()}/${auction.finish.getMonth()}/${auction.finish.getYear()}`}
                                                </MenuItem>
                                            )
                                        }
                                    </Select>
                                </TableCell>
                                <TableCell align="right">
                                    {/* <Datetime
                                        disabled
                                        value={date}
                                        onChange={date => setDate(date ? date.toDate() : null)}
                                        inputProps={{
                                            placeholder: "Date of Event"
                                        }}
                                    /> */}
                                    <TextField disabled id="date" label="Date" value={date} onChange={event => setDate(event.target.value)} />
                                </TableCell>
                                <TableCell align="right">
                                    <TextField required id="note" label="Note" value={note} onChange={event => setNote(event.target.value)} />
                                </TableCell>
                                <TableCell align="center">
                                    <Button
                                        variant="contained"
                                        color="default"
                                        startIcon={<CloudUploadIcon />}
                                        onClick={() => create()}
                                    // disabled={!validCreate}
                                    >
                                        Create
                                    </Button>
                                    &nbsp;
                                    {/* <Button
                                        variant="contained"
                                        color="primary"
                                        startIcon={<SaveIcon />}
                                        onClick={() => save()}
                                    disabled={!validSave}
                                    >
                                        Save
                                    </Button> */}
                                </TableCell>
                            </TableRow>
                            {
                                userCalendar.map(cal =>
                                    // style={{ backgroundColor: 'red', color: 'white' }}
                                    <TableRow key={cal.id}>
                                        <TableCell align="right">{cal.event}</TableCell>
                                        {/* <TableCell align="right">{new Date(cal.date)}</TableCell> */}
                                        <TableCell>{`${new Date(cal.date).toDateString()} ${new Date(cal.date).toLocaleTimeString()}`}</TableCell>
                                        <TableCell align="right">{cal.note}</TableCell>
                                        <TableCell>
                                            {/* <Button onClick={() => edit(cal)}>Edit</Button> */}
                                            <Button onClick={() => remove(cal)}>Delete</Button>
                                        </TableCell>
                                    </TableRow>
                                )
                            }
                        </TableBody>
                    </Table>
                </TableContainer>
                <Button size="small" component={Link} to={"/"} >Back to Home Page</Button>
            </GridContainer>
        </div >

    )
}
